<?php

namespace App\UseCases;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ListAction
{
    /**
     * Handle the incoming request.
     *
     * @return RedirectResponse|void
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model, array $attributes = [])
    {
        // リソースに紐づいたモデル
        $model = new $model;

        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        // ソート条件
        $model = $model->orderBy($sort, $order);

        // paginateで取得する
        $collections = $model->paginate(2);

        return $collections;
    }
}
