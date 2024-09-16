<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    /**
     * 一覧表示前処理
     */
    protected function checkSortParameter(Request $request): array
    {
        // ソート順番がない場合はリダイレクト
        $redirectParam = [];
        if (! $request->get('sort')) {
            $redirectParam['sort'] = 'owner_sequence_no';
        }
        if (! $request->get('order')) {
            $redirectParam['order'] = 'asc';
        }
        if (! $request->get('rows')) {
            $redirectParam['rows'] = config('custom.paginate.default');
        }

        return $redirectParam;
    }
}
