<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    /**
     * 一覧表示前処理
     */
    protected function checkSortParameter(Request $request): void
    {
        // ソート順番がない場合はリダイレクト
        $redirectParam = [];
        if (! $request->get('sort')) {
            $redirectParam['sort'] = 'id';
        }
        if (! $request->get('order')) {
            $redirectParam['order'] = 'asc';
        }
        if (! empty($redirectParam)) {
            redirect()->route($this->model->getTable().'.index', $redirectParam);
        }
    }
}
