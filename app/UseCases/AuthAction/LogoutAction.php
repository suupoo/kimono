<?php

namespace App\UseCases\AuthAction;

use App\UseCases\BaseAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    /**
     * セッショントークンを更新する（二重送信対策）
     */
    public function updateCsrfToken(): void
    {
        // ログアウトのため、セッショントークンを無効化
        request()->session()->invalidate();

        // セッショントークンの再生成（二重送信対策）
        if (env('APP_ENV') !== 'local') {
            // ローカルで検証する際は二重送信可能
            request()->session()->regenerateToken();
        }
    }

    public function __invoke(Request $request): RedirectResponse
    {
        // ログアウト
        Auth::logout();

        // セッショントークンの再生成（二重送信対策）
        $this->updateCsrfToken();

        return redirect()->route('login');
    }
}
