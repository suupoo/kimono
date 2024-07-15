<?php

namespace App\UseCases\SystemAction\Function;

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
            $newFunctions = $request->get('functions');

            // 現在のリソースに紐づいた機能を取得
            foreach ($model->all() as $mFunction) {
                if(!array_key_exists($mFunction->key, $newFunctions) && $mFunction->enable == Flag::ON->value) {
                    // 無効化
                    $mFunction->enable = false;
                }else if(array_key_exists($mFunction->key, $newFunctions) && $mFunction->enable == Flag::OFF->value){
                    // 有効化
                    $mFunction->enable = true;
                }

                // 更新
                if($mFunction->isDirty()) $mFunction->save();
            }

            return redirect()->route('system.listFunction')
                ->with('message', '保存しました。');

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
