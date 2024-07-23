<?php

namespace App\UseCases\ResourceAction;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * リソース新規作成アクション
 */
class CreateAction extends ResourceAction
{
    /**
     * Handle the incoming request.
     *
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model, array $attributes = []): RedirectResponse
    {
        // セッショントークンの再生成（二重送信対策）
        $this->updateCsrfToken();

        // アクション開始時の処理
        $this->startOfAction($request, $model);

        // リソースに紐づいたモデルインスタンスを生成
        $model = new $model;

        // バリデーションルールの生成
        $rules = [];
        $columns = $model->getColumns();
        $attributeNames = [];
        foreach ($columns as $column) {
            $rules[$column->id()] = $column->rules();
            $attributeNames[$column->id()] = $column->label();
        }

        // バリデーション実行前の処理
        $this->beforeOfValidate($request, $model, [
            'rules' => &$rules,
            'columns' => &$columns,
        ]);

        // バリデーション
        $validator = Validator::make($request->all(), $rules)
            // バリデーション実行時の項目名はVOのlabelを参照
            ->setAttributeNames($attributeNames);
        // バリデーション実行前の処理
        $this->afterOfValidate($request, $model, [
            'validator' => &$validator,
            'columns' => &$columns,
        ]);

        // バリデーションエラー
        if ($validator->fails()) {
            $redirectRouteName = $model->getTable().'.create';

            // バリデーションエラー時は入力画面へ入力値を返して戻る
            return redirect()->route($redirectRouteName)
                ->withErrors($validator)
                ->withInput();
        }

        // ルーティング名のプレフィックスを取得
        $routePrefix = $this->prefix ?? $model->getTable();
        try {
            // トランザクションで処理する
            DB::beginTransaction();

            // 値をfillするために column_name => input_name の形式でデータ整形
            $attributes = [];
            foreach ($columns as $column) {
                if (array_key_exists($column->id(), $validator->validated())) {
                    $attributes[$column->column()] = $validator->validated()[$column->id()];
                }
            }

            // 新規作成前の処理
            $this->beforeOfCreate($request, $model, [
                'attributes' => &$attributes,
            ]);

            // 新規作成
            $createdEntity = $model::create($attributes);

            // 新規作成後の処理
            $this->afterOfCreate($request, $model, [
                'attributes' => &$attributes,
                'entity' => &$createdEntity,
            ]);

            // コミット
            DB::commit();

            // コミット後の処理
            $this->afterOfCommit($request, $model, [
                'attributes' => &$attributes,
                'entity' => &$createdEntity,
            ]);

            // 正常終了時は一覧画面へリダイレクト
            return redirect()->route($routePrefix.'.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);

            // エラー時は入力画面へ入力値を返して戻る
            return redirect()->route($routePrefix.'.create')->withInput()
                ->withErrors(['error' => __('Error of General')]);
        }
    }
}
