<?php

namespace App\UseCases\AttendanceAction;

use App\UseCases\ResourceAction\CreateAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class CreateAction
 * 新規登録アクション
 */
class CreateAction extends BaseAction
{
    protected function beforeOfCreate(Request $request, string $model, array $attributes = []): void
    {
        // UUIDを生成
        $attributes['attributes']['uuid'] = Str::uuid();
    }
}
