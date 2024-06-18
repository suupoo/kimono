<?php

namespace App\UseCases\ResourceAction;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UpdateAction extends ResourceAction
{
    /**
     * Handle the incoming request.
     *
     * @return RedirectResponse|void
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model)
    {
        // セッショントークンの再生成（二重送信対策）
        $this->updateCsrfToken();

        // アクション開始時の処理
        $this->startOfAction($request, $model);

        // リソースに紐づいたモデル
        $model = new $model;

        // バリデーションルールの生成
        $rules = [];
        $columns = $model->getColumns();
        $attributeNames = [];
        foreach ($columns as $column) {
            $rules[$column->id()] = $column->rules();
            $attributeNames[$column->column()] = $column->label();
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
            $redirectRouteName = $model->getTable().'.edit';

            // バリデーションエラー時は入力画面へ入力値を返して戻る
            return redirect()->route($redirectRouteName, ['id' => $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // トランザクションで処理する
            DB::beginTransaction();

            $updateEntity = $model->findOrFail($validator->validated()['id']);

            $attributes = [];
            foreach ($columns as $column) {
                if (array_key_exists($column->id(), $validator->validated())) {
                    $attributes[$column->column()] = $validator->validated()[$column->id()];
                }
            }

            // 更新前の処理
            $this->beforeOfUpdate($request, $model, [
                'attributes' => &$attributes,
                'entity' => &$updateEntity,
            ]);

            // 更新
            $updateEntity->fill($attributes)->save();

            // 更新後の処理
            $this->afterOfUpdate($request, $model, [
                'attributes' => &$attributes,
                'entity' => &$updateEntity,
            ]);

            // コミット
            DB::commit();

            // コミット後の処理
            $this->afterOfCommit($request, $model, [
                'attributes' => &$attributes,
                'entity' => &$updateEntity,
            ]);

            // 閲覧画面に戻す処理
            return redirect()->route($model->getTable().'.show', ['id' => $request->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);

            // エラー時は入力画面へ入力値を返して戻る
            return redirect()->route($model->getTable().'.edit', [
                'id' => $request->id,
            ])->withInput()
                ->withErrors(['error' => __('Error of General')]);
        }
    }
}
