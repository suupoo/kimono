<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    /**
     * 一覧表示<index>画面でのデフォルトの一覧表示条件設定
     * @return array
     */
    public function defaultSortParameters(): array
    {
        return [
            'sort'  => 'owner_sequence_no',
            'order' => 'asc',
            'rows'  => config('custom.paginate.default'),
        ];
    }

    /**
     * 一覧表示前処理
     */
    protected function checkSortParameter(Request $request): array
    {
        $defaultSortParameters = $this->defaultSortParameters();
        // ソート順番がない場合はリダイレクト
        $redirectParam = [];
        if (! $request->get('sort')) {
            $redirectParam['sort']  = $defaultSortParameters['sort'];
        }
        if (! $request->get('order')) {
            $redirectParam['order'] = $defaultSortParameters['order'];
        }
        if (! $request->get('rows')) {
            $redirectParam['rows']  = $defaultSortParameters['rows'];
        }

        return $redirectParam;
    }
}
