<?php

namespace App\UseCases\AuthAction;

use App\UseCases\BaseAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginAction
{
    /**
     * セッショントークンを更新する（二重送信対策）
     */
    public function updateCsrfToken(): void
    {
        // セッショントークンの再生成（二重送信対策）
        if (env('APP_ENV') !== 'local') {
            // ローカルで検証する際は二重送信可能
            request()->session()->regenerateToken();
        }
    }

    public function __invoke(Request $request, string $authModel): RedirectResponse
    {
        // セッショントークンの再生成（二重送信対策）
        $this->updateCsrfToken();

        // リソースに紐づいたモデルインスタンスを生成
        $model = new $authModel;

        // バリデーションルールの生成
        $rules = [];
        $columns = $model->getColumns();
        $attributeNames = [];
        foreach ($columns as $column) {
            $rules[$column->id()] = $column->rules();
            $attributeNames[$column->id()] = $column->label();
        }

        // バリデーション
        $validator = Validator::make($request->all(), $rules)
            // バリデーション実行時の項目名はVOのlabelを参照
            ->setAttributeNames($attributeNames);

        // バリデーションエラー
        if ($validator->fails()) {
            // バリデーションエラー時はログイン画面へ入力値を返して戻る
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            if(Auth::attempt([
                'email' =>  $validator->validated()['email'],
                'password' => $validator->validated()['password'],
            ])){
                // 認証成功時は①ログインを行った画面②ホーム画面の順で該当画面へリダイレクト
                return redirect()->intended(route('home'));
            }

            // 認証失敗時
            return redirect()->route('login')->withInput(['email'])
                ->withErrors(['error' => __('auth.failed')]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);

            // エラー時は入力画面へ入力値を返して戻る
            return redirect()->route('login')->withInput()
                ->withErrors(['error' => __('Error of General')]);
        }
    }
}
