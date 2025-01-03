<?php

namespace App\UseCases\SystemAction\Holiday;

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

            // ロケールを設定
            $request->merge([
                'locale' => 'ja',
            ]);

            // リソースに紐づいたモデル
            $model = new $model;

            // 新規作成または更新
            $mHoliday = $model->updateOrCreate(
                ['date' => $request->get('date'), 'locale' => $request->get('locale')],
                $request->except(['_token', 'date', 'locale'])
            );

            if ($mHoliday->isDirty()) {
                $mHoliday->save();
            }

            return redirect()->route('system.listHoliday')
                ->with('message', '保存しました。');

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
