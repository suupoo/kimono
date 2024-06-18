<?php

namespace App\UseCases\UserAction;

use App\UseCases\ResourceAction\UpdateAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class CreateAction
 * 顧客新規登録アクション
 */
class UpdateAction extends BaseAction
{
    public function afterOfUpdate(Request $request, string $model, array $attributes = []): void
    {
        // todo:ここで認証用のメールを送る
        Log::info('send mail to user.');
    }
}
