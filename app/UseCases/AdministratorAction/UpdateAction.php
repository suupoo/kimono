<?php

namespace App\UseCases\AdministratorAction;

use App\Mail\User\VerifyEmailFromSystem;
use App\UseCases\ResourceAction\UpdateAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class CreateAction
 * 顧客新規登録アクション
 */
class UpdateAction extends BaseAction
{
    /**
     * コミット後の処理
     */
    public function afterOfCommit(Request $request, string $model, array $attributes = []): void
    {
        try {
            $entity = $attributes['entity'];
            // メールアドレスが変更されている場合は認証メールを送信する
            if ($entity->wasChanged('email')) {
                $email = $entity->email;
                Mail::to($email)->send(new VerifyEmailFromSystem());
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
