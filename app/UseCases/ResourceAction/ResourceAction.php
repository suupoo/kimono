<?php

namespace App\UseCases\ResourceAction;

use Illuminate\Http\Request;

class ResourceAction
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

    /**
     * アクション開始時の処理
     */
    protected function startOfAction(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * アクション終了時の処理
     */
    protected function endOfAction(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * バリデーション実行前時の処理
     */
    protected function beforeOfValidate(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * バリデーション実行前時の処理
     */
    protected function afterOfValidate(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * 新規作成処理実行前の処理
     */
    protected function beforeOfCreate(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * 新規作成処理実行後の処理
     */
    protected function afterOfCreate(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * コミット後の処理
     */
    protected function afterOfCommit(Request $request, string $model, array $attributes = []): void
    {

    }
}
