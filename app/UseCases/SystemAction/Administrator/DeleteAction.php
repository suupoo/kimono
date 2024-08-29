<?php

namespace App\UseCases\SystemAction\Administrator;

use App\UseCases\ResourceAction\DeleteAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DeleteAction
 * 顧客削除登録アクション
 */
class DeleteAction extends BaseAction
{
    protected function beforeOfDelete(Request $request, string $model, array $attributes = []): void
    {
        $entity = $attributes['entity'];
        // ログイン中のユーザは削除できない
        if (Auth::id() === $entity->id) {
            throw new \Exception(__('auth.current_logged_in_user_must_not_delete_itself'));
        }
    }
}
