<?php

namespace App\UseCases\ResourceAction;

use Illuminate\Http\Request;

class ResourceAction
{
    /**
     * セッショントークンを更新する（二重送信対策）
     * @return void
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
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return void
     */
    protected function startOfAction(Request $request, string $model, array $attributes = []):void
    {
        return ;
    }

    /**
     * アクション終了時の処理
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return void
     */
    protected function endOfAction(Request $request, string $model, array $attributes = []):void
    {
        return ;
    }

    /**
     * バリデーション実行前時の処理
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return void
     */
    protected function beforeOfValidate(Request $request, string $model, array $attributes = []):void
    {
        return;
    }

    /**
     * バリデーション実行前時の処理
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return void
     */
    protected function afterOfValidate(Request $request, string $model, array $attributes = []):void
    {
        return;
    }

    /**
     * 新規作成処理実行前の処理
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return void
     */
    protected function beforeOfCreate(Request $request, string $model, array $attributes = []):void
    {
        return;
    }

    /**
     * 新規作成処理実行後の処理
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return void
     */
    protected function afterOfCreate(Request $request, string $model, array $attributes = []):void
    {
        return;
    }

    /**
     * コミット後の処理
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return void
     */
    protected function afterOfCommit(Request $request, string $model, array $attributes = []):void
    {
        return;
    }
}
