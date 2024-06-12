<?php

namespace App\UseCases;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateAction
{
    /**
     * Handle the incoming request.
     * @param Request $request
     * @param string $model
     * @return RedirectResponse|void
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model)
    {
        // セッショントークンの再生成（二重送信対策）
        if(env('APP_ENV') !== 'local'){
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
        $validator->validate();

        // バリデーションエラー
        if ($validator->fails()) {
            // バリデーションエラー、入力値を返して戻る
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // トランザクションで処理する
            DB::beginTransaction();

            // 値をfillするために column_name => input_name の形式でデータ整形
            $attributes = [];
            foreach ($columns as $column) {
                if(array_key_exists($column->id(), $validator->validated())){
                    $attributes[$column->column()] = $validator->validated()[$column->id()];
                }
            }

            // 新規作成
            $model::create($attributes);

            // コミット
            DB::commit();

            // 一覧画面に戻す処理
            redirect()->route($model->getTable() . '.index');

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
