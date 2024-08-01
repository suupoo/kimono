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
            $redirectParam['sort'] = 'id';
        }
        if (! $request->get('order')) {
            $redirectParam['order'] = 'asc';
        }

        return $redirectParam;
    }
}
