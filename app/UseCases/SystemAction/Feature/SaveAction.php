<?php

namespace App\UseCases\SystemAction\Feature;

use App\Enums\Flag;
use App\UseCases\ResourceAction\ListAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class CreateAction
 * 保存アクション
 */
class SaveAction extends BaseAction
{

    public function __invoke(Request $request, string $model, array $attributes = [])
    {
        try {
            // リソースに紐づいたモデル
            $model = new $model;

            // リクエストから取得
            $newFeatures = $request->get('features');

            // 現在のリソースに紐づいた機能を取得
            foreach ($model->switchable()->get() as $mFeature) {
                if( empty($newFeatures) || (!array_key_exists($mFeature->key, $newFeatures) && $mFeature->enable == Flag::ON->value) ) {
                    // 無効化
                    $mFeature->enable = false;
                }else if(array_key_exists($mFeature->key, $newFeatures) && $mFeature->enable == Flag::OFF->value){
                    // 有効化
                    $mFeature->enable = true;
                }

                // 更新
                if($mFeature->isDirty()) $mFeature->save();
            }

            return redirect()->route('system.listFeature')
                ->with('message', '保存しました。');

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
