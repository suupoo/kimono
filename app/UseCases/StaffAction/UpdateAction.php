<?php

namespace App\UseCases\StaffAction;

use App\Facades\Utility\CustomStorage;
use App\UseCases\ResourceAction\UpdateAction as BaseAction;
use App\ValueObjects\Staff\Image;
use Illuminate\Http\Request;

/**
 * Class CreateAction
 * 新規登録アクション
 */
class UpdateAction extends BaseAction
{
    /**
     * 更新処理実行前の処理
     * @param Request $request
     * @param string $model
     * @param array $attributes
     */
    protected function beforeOfUpdate(Request $request, string $model, array $attributes = []): void
    {
        $dataAttributes = $attributes['attributes'];
        $dataEntity = $attributes['entity'];

        // ファイルがある場合はアップロード
        if(array_key_exists('image',$dataAttributes)){
            // 登録済みの場合は削除
            if($dataEntity->image){
                CustomStorage::disk()->delete($dataEntity->image);
            }

            $image = new Image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $uploadPath = CustomStorage::disk()
                ->putFileAs($image->fileUploadPath(), $request->file('image'), $image->createFileName($extension));
            if ($uploadPath){
                $attributes['attributes']['image'] = $uploadPath;
            }
        }
    }
}
