<?php

namespace App\UseCases;

/**
 * Class Action
 * アクション
 */
abstract class Action
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
}
