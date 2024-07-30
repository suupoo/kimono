<?php

namespace App\Facades\Utility;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\UnableToWriteFile;
use OpenStack\Common\Error\BadResponseError;
use OpenStack\OpenStack;
use Throwable;

class CustomStorageOpenStackService
{
    protected $client;
    protected $container;
    protected $identityV2;
    protected $objectStoreV1;
    protected $config;

    public function __construct($config = [])
    {
        $this->config = $config;
        $openstack = new OpenStack([
            'authUrl' => $config['auth'],
            'username' => $config['username'],
            'password' => $config['password'],
            'tenantName' => $config['tenant_name'],
        ]);
        $this->container = $config['container'];
        $this->identityV2 = $openstack->identityV2([
            'username' => $config['username'],
            'password' => $config['password']
        ]);
        $this->objectStoreV1 = $openstack->objectStoreV1([
            'identityService' => $this->identityV2,
            'catalogName' => 'Object Storage Service',
            'region' => $config['region'],
        ]);
    }

    /**
     * ファイルのアップロード
     * @param string $path
     * @param UploadedFile $contents
     * @param array $options
     * @return false|string
     * @throws BadResponseError
     * @throws FileNotFoundException
     */
    public function putFile(string $path, UploadedFile $contents, array $options = []): false|string
    {
        $filePath = printf("%s/%s.%s",
            $path,
            $this->fileNameFormat(),
            $contents->extension()
        );
        return $this->upload($filePath, $contents);
    }

    /**
     * ファイルに名前をつけてアップロード
     * @param string $path
     * @param UploadedFile $contents
     * @param $fileName
     * @param array $options
     * @return false|string
     * @throws BadResponseError
     * @throws FileNotFoundException
     */
    public function putFileAs(string $path, UploadedFile $contents, $fileName, array $options = []): false|string
    {
        $filePath = sprintf("%s/%s",
            $path,
            $fileName,
        );
        return $this->upload($filePath, $contents);
    }

    /**
     * ファイルをアップロードする
     *
     * @param $path
     * @param UploadedFile $contents
     * @return false|string
     * @throws BadResponseError
     * @throws FileNotFoundException
     */
    private function upload($path, UploadedFile $contents) : false|string
    {
        try {
            $containerPath = $this->containerPath($path);
            $directories = $this->directories($containerPath);

            // ユーザディレクトリを追加
            $directories[] = $this->userDirectory();

            // ファイル名
            $fileName = $this->fileName($containerPath);

            // コンテナが存在しない場合は作成していく
            $container = '';
            foreach ($directories as $index => $directory) {
                $container .= ($index === 0)
                    ? $directory
                    : '/' . $directory;
                $exist = $this->objectStoreV1->containerExists($container);
                if (!$exist) {
                    $this->objectStoreV1->createContainer(['name' => $container]);
                }
            }

            // アップロード
            $this->objectStoreV1->getContainer($container)
                ->createObject([
                    'name' => $fileName,
                    'content' => $contents->get(),
                ]);

            // ルートコンテナ名を除いてアップロードしたファイルのパスを返す
            return $this->relativePath($container.'/'.$fileName);

        }catch (UnableToWriteFile $e) {
            Log::error($e->getMessage());
        }

        return false;
    }

    /**
     * ファイルの一時URLを取得
     * @param string $path
     * @param Carbon $expiration
     * @param array $options
     * @return string
     */
    public function temporaryUrl(string $path, Carbon $expiration, array $options = []):string
    {
        $containerPath = $this->containerPath($path);
        $key = $this->config['temporary_url_key'];

        $method = 'GET';
        $expires = $expiration->unix();
        $path = sprintf('/%s/%s',
            $this->objectStorageVersionSlashNcTenantId(),
            $containerPath,
        );

        $hmac_body = "$method\n$expires\n$path";
        $sig = hash_hmac('sha1', $hmac_body, $key);

        return printf('%s/%s?temp_url_sig=%s&temp_url_expires=%s',
            $this->getObjectStorageEndpoint(),
            $containerPath,
            $sig,
            $expires
        );
    }

    /**
     * ファイルの削除
     * @param string|array $files
     * @return bool
     */
    public function delete(string|array $files): bool
    {
        if(is_array($files)){
            foreach ($files as $file) {
                $this->deleteFile($file);
            }
        }else{
            $this->deleteFile($files);
        }
        return true;
    }

    /**
     * ファイルの削除
     * @param string $path
     * @return void
     */
    public function deleteFile(string $path): void
    {
        try {
            // コンテナのフルパス変換
            $containerPath = $this->containerPath($path);

            // コンテナのパスのみを取得
            $pathExploded = explode('/', $containerPath);
            $fileName = array_pop($pathExploded);
            $container = implode('/', $pathExploded);

            // コンテナのオブジェクトを取得して削除
            $container = $this->objectStoreV1->getContainer($container);
            $file = $container->getObject($fileName);

            // 削除
            $file->delete();

        } catch (Throwable $exception) {
            throw UnableToDeleteFile::atLocation($path, '', $exception);
        }
    }

    /**
     * ファイル名のフォーマット
     * @return string
     */
    private function fileNameFormat()
    {
        return Carbon::now()->format('YmdHis');
    }

    /**
     * ユーザ毎のディレクトリ
     * @return string
     */
    private function userDirectory(): string
    {
        return (auth()->check())
            ? (string)auth()->id()
            : 'anonymous';
    }

    /**
     * コンテナのフルパスに変換する
     * @param $path
     * @return string
     */
    private function containerPath($path): string
    {
        return $this->container . '/' . $path;
    }

    /**
     * コンテナのルートパスを除いた相対パスに変換する
     * @param $path
     * @return string
     */
    private function relativePath($path): string
    {
        $containerRoot = $this->container . '/';
        return str_replace($containerRoot, '', $path);
    }

    /**
     * ファイル名を取得
     * @param $path
     * @return string
     */
    private function fileName($path): string
    {
        $path = explode('/', $path);
        return end($path);
    }

    /**
     * ディレクトリを取得
     * @param $path
     * @return array
     */
    private function directories($path): array
    {
        $path = explode('/', $path);
        array_pop($path);
        return $path;
    }

    /**
     * エンドポイントのうち、バージョンとテナントIDをスラッシュでつなげる
     * note:temporaryUrlでも使用する
     * @return string
     */
    private function objectStorageVersionSlashNcTenantId(): string
    {
        return sprintf('%s/nc_%s',
            $this->config['object_storage']['version'],
            $this->config['tenant_id']
        );
    }

    /**
     * オブジェクトストレージのエンドポイントを取得
     * @return string
     */
    private function getObjectStorageEndpoint(): string
    {
        return sprintf('%s/%s',
            $this->config['object_storage']['url'],
            $this->objectStorageVersionSlashNcTenantId()
        );
    }

}
