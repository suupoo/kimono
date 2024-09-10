<?php

namespace App\UseCases\SystemAction\Administrator;

use Illuminate\Auth\Events\Registered;
use App\Notifications\Mail\CreateSystemAdministratorVerifiedMailNotification;
use App\UseCases\ResourceAction\CreateAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

            // メール認証トークンを生成して登録する
            $registerEmailVerification = $entity->registerEmailVerification();
            if(!$registerEmailVerification){
                throw new \Exception('認証トークンの生成に失敗しました。');
            }

            // 認証メールを送信する
            $entity->notify(
                new CreateSystemAdministratorVerifiedMailNotification([
                    'entity' => $entity,
                    'url'    => route('verify-email', ['token' => $registerEmailVerification->token]),
                    'expire' => $registerEmailVerification->expired_at->format('Y/m/d H:i'),
                ])
            );

            // ユーザ登録イベントを発行
            event(new Registered($entity));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
