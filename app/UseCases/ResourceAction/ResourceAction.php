<?php

namespace App\UseCases\ResourceAction;

use App\UseCases\Action;
use App\UseCases\Traits\PrefixSettable;
use Illuminate\Http\Request;

class ResourceAction extends Action
{
    use PrefixSettable;

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
     * 検索実行前の処理
     */
    protected function beforeOfSearch(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * 検索実行後の処理
     */
    protected function afterOfSearch(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * 検索条件整理実行前の処理
     */
    protected function prepareSearchCondition(Request $request, string $model, array $attributes = []): void
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
     * 更新処理実行前の処理
     */
    protected function beforeOfUpdate(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * 更新処理実行後の処理
     */
    protected function afterOfUpdate(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * 削除処理実行前の処理
     */
    protected function beforeOfDelete(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * 削除処理実行後の処理
     */
    protected function afterOfDelete(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * コミット後の処理
     */
    protected function afterOfCommit(Request $request, string $model, array $attributes = []): void
    {

    }

    /**
     * エクスポート処理前の処理
     */
    protected function beforeOfExport(Request $request, string $model, array $attributes = []): void
    {

    }


    /**
     * エクスポート処理整形後の処理
     */
    protected function formattingOfExport(Request $request, string $model, array $attributes = []): void
    {

    }
}
