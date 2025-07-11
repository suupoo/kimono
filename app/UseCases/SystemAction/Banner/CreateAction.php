<?php

namespace App\UseCases\SystemAction\Banner;

use App\Facades\Utility\CustomStorage;
use App\UseCases\ResourceAction\CreateAction as BaseAction;
use App\ValueObjects\Master\Banner\Image;
use Illuminate\Http\Request;

/**
 * Class CreateAction
 * 新規登録アクション
 */
class CreateAction extends BaseAction
{
    /**
     * 新規作成処理実行前の処理
     *
     * @throws \Exception
     */
    protected function beforeOfCreate(Request $request, string $model, array $attributes = []): void
    {
        $dataAttributes = $attributes['attributes'];

        // ファイルがある場合はアップロード
        if (array_key_exists('image', $dataAttributes)) {
            $image = new Image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $uploadPath = CustomStorage::disk()
                ->putFileAs($image->fileUploadPath(), $request->file('image'), $image->createFileName($extension));
            if ($uploadPath) {
                $attributes['attributes']['image'] = $uploadPath;
            }
        }
    }
}
