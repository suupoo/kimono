<?php

namespace App\Facades\Utility;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomStorageService
{
    protected $storage;

    protected $disk;

    protected $config;

    public function disk(): self
    {
        $disk = config('filesystems.default');
        $config = config('filesystems.disks.'.$disk);

        $this->disk = $disk;
        $this->config = $config;

        if ($disk == 'openstack') {
            $this->storage = new CustomStorageOpenStackService($config);
        } else {
            $this->storage = Storage::disk($disk);
        }

        return $this;
    }

    /**
     * ユーザごとのディスク設定
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function userDisk(): self
    {
        $user = Auth::user();
        // 未ログイン
        if (! $user) {
            throw new \Exception('Not found user');
        }

        $disk = config('filesystems.default');
        $config = config('filesystems.disks.'.$disk);

        if ($disk == 'openstack') {
            // ユーザ設定
            if (! $user->has_system_company) {
                // 企業登録がまだの場合
                throw new \Exception('Not found user company');
            }
            $mSystemCompany = $user->systemCompanies->first(); // note:1社のみの場合のみ対応
            $config['tenant_name'] = $mSystemCompany->conoha_tenant_name;
            $config['tenant_id'] = $mSystemCompany->conoha_tenant_id;
            $config['username'] = $mSystemCompany->conoha_tenant_username;
            $config['password'] = $mSystemCompany->conoha_tenant_password;
            $config['temporary_url_key'] = $mSystemCompany->conoha_tenant_temporary_url_key;
            $config['container'] = $mSystemCompany->conoha_container_name;

            $this->disk = $disk;
            $this->config = $config;

            $this->storage = new CustomStorageOpenStackService($config);
        } else {
            throw new \Exception('Not supported disk');
        }

        return $this;
    }

    /**
     * ファイルのアップロード
     */
    public function putFile($path, $content, array $options = []): false|string
    {
        return $this->storage->putFile($path, $content, $options);
    }

    /**
     * ファイル名をつけてファイルのアップロード
     */
    public function putFileAs($path, $content, $fileName, array $options = []): false|string
    {
        return $this->storage->putFileAs($path, $content, $fileName, $options);
    }

    /**
     * 一時的なURLを取得
     */
    public function temporaryUrl($path, $expiration): string
    {
        return $this->storage->temporaryUrl($path, $expiration);
    }

    /**
     * ファイルの削除
     */
    public function delete(string|array $paths): void
    {
        $this->storage->delete($paths);
    }
}
