<?php

namespace App\UseCases\SystemAction\Administrator;

use App\Mail\CreateSystemAdministratorVerifiedEmail;
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
            // 認証メールを送信する
            $entity->notify(
                new CreateSystemAdministratorVerifiedMailNotification([
                    'entity' => $entity,
                ])
            );

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
