<?php

namespace App\UseCases\ResourceAction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class DeleteAction
 * 削除アクション
 */
class DeleteAction extends ResourceAction
{
    public function __invoke(Request $request, string $model)
    {
        // セッショントークンの再生成（二重送信対策）
        $this->updateCsrfToken();

        // アクション開始時の処理
        $this->startOfAction($request, $model);

        // 暗号化された検索条件を復号
        $search = Crypt::decrypt($request->get('search'));

        // リソースに紐づいたモデルインスタンスを生成
        $model = new $model;

        try {
            // トランザクションで処理する
            DB::beginTransaction();

            // 削除対象のエンティティを取得
            $deleteEntity = $model->findOrFail($request->id);

            // 削除前の処理
            $this->beforeOfDelete($request, $model, [
                'entity' => &$deleteEntity,
            ]);

            // 新規作成
            $deleted = $deleteEntity->delete();

            // 削除後の処理
            $this->afterOfDelete($request, $model, [
                'attributes' => &$attributes,
                'deleted' => &$deleted,
                'entity' => &$deleteEntity,
            ]);

            // コミット
            DB::commit();

            // コミット後の処理
            $this->afterOfCommit($request, $model, [
                'attributes' => &$attributes,
                'entity' => &$deleteEntity,
            ]);

            // 正常終了時は一覧画面へリダイレクト
            return redirect()->route($model->getTable().'.index', $search);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);

            // エラー時は入力画面へ入力値を返して戻る
            return redirect()->route($model->getTable().'.index', $search)->withInput()
                ->withErrors(['error' => __('Error of General')]);
        }
    }
}
