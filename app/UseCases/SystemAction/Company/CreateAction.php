<?php

namespace App\UseCases\SystemAction\Company;

use App\UseCases\ResourceAction\CreateAction as BaseAction;
use Illuminate\Support\Str;

/**
 * Class CreateAction
 * 新規登録アクション
 */
class CreateAction extends BaseAction
{
    /**
     * 新規登録前処理
     */
    public function beforeOfCreate($request, $model, array $attributes = []): void
    {
        // UUIDを生成
        $attributes['attributes']['uuid'] = Str::uuid();
    }
}
