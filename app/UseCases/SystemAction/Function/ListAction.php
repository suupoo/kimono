<?php

namespace App\UseCases\SystemAction\Function;

use App\UseCases\ResourceAction\ListAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class CreateAction
 * 顧客新規登録アクション
 */
class ListAction extends BaseAction
{

    public function __invoke(Request $request, string $model, array $attributes = [])
    {
        try {
            // リソースに紐づいたモデル
            $model = new $model;

            return
                $model::all();

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }

}
