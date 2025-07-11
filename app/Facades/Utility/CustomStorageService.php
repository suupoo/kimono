<?php

namespace App\Facades\Utility;

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
