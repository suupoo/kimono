<?php

namespace App\UseCases;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateAction
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
        if (env('APP_ENV') !== 'local') {
            // ローカルで検証する際は二重送信可能
            $request->session()->regenerateToken();
        }

        // リソースに紐づいたモデル
        $model = new $model;

        // バリデーションルールの生成
        $rules = [];
        $columns = $model->getColumns();
        foreach ($columns as $column) {
            $rules[$column->id()] = $column->rules();
        }

        // ①バリデーション
        $validator = Validator::make($request->all(), $rules);

        // バリデーションエラー
        if ($validator->fails()) {
            $redirectRouteName = $model->getTable().'.edit';

            dd($validator->errors());

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

            // 更新
            $updateEntity->fill($attributes)->save();

            // コミット
            DB::commit();

            // 一覧画面に戻す処理
            return redirect()->route($model->getTable().'.edit', ['id' => $updateEntity->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
