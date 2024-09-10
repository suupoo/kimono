<?php

namespace App\UseCases\AuthAction;

use App\Models\SystemEmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VerifyEmailAction
{
    public function __invoke(Request $request, string $authModel): void
    {

        $error = null;

        if(Auth::check()) {
            // ログイン済みの場合はログアウト処理を行う
            Auth::logout();
        }

        // バリデーションルールの生成
        $rules = [
            'token' => 'required|string'
        ];

        // バリデーション
        $validator = Validator::make($request->all(), $rules)
            ->setAttributeNames([
                'token' => '認証情報',
            ]);

        // バリデーションエラー
        if ($validator->fails()) {
            $error = '認証情報が不正です';
        }

        try {

            // バリデーションエラー時
            if($error) throw new \Exception($error);

            DB::beginTransaction();

            // トークンからデータを取得
            $token = $validator->validated()['token'];
            $systemEmailVerification = SystemEmailVerification::query()->where([
                'model' => $authModel,
                'token' => $token,
            ])->first();

            // トークンが存在しない、認証済み、有効期限切れの場合はエラー
            if(!$systemEmailVerification) {
                $error = '認証情報が不正です';
            }else if ($systemEmailVerification->is_verified) {
                $error = 'すでに認証済みです';
            }else if ($systemEmailVerification->expired_at < now()) {
                $error = '認証情報の有効期限が切れています';
            }

            $user = $authModel::find($systemEmailVerification->models_id);
            if (!$user) {
                $error = 'ユーザーが存在しません';
            }

            if ($error) throw new \Exception($error);

            // 認証済みに更新
            $user->email_verified_at = now();
            if($user->save()){
                // 認証済みに更新
                $systemEmailVerification->is_verified = true;
                $systemEmailVerification->save();
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);

            // エラー時は入力画面へ入力値を返して戻る
            abort(400, $e->getMessage());
        }
    }
}
