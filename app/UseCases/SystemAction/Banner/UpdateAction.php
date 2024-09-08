<?php

namespace App\UseCases\SystemAction\Banner;

use App\Facades\Utility\CustomStorage;
use App\UseCases\ResourceAction\UpdateAction as BaseAction;
use App\ValueObjects\Master\Banner\Image;
use Illuminate\Http\Request;

/**
 * Class UpdateAction
 * 更新アクション
 */
class UpdateAction extends BaseAction
{
    /**
     * 更新処理実行前の処理
     */
    protected function beforeOfUpdate(Request $request, string $model, array $attributes = []): void
    {
        $dataAttributes = $attributes['attributes'];
        $dataEntity = $attributes['entity'];

        // ファイルがある場合はアップロード
        if (array_key_exists('image', $dataAttributes)) {
            // 登録済みの場合は削除
            if ($dataEntity->image) {
                CustomStorage::disk()->delete($dataEntity->image);
            }

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
