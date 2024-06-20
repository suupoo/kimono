<?php

namespace App\UseCases\UserAction;

use App\Mail\User\VerifyEmailFromSystem;
use App\UseCases\ResourceAction\CreateAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class CreateAction
 * 顧客新規登録アクション
 */
class CreateAction extends BaseAction
{
    /**
     * コミット後の処理
     */
    public function afterOfCommit(Request $request, string $model, array $attributes = []): void
    {
        try {
            $entity = $attributes['entity'];
            // 認証メールを送信する
            $email = $entity->email;
            Mail::to($email)->send(new VerifyEmailFromSystem());

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
