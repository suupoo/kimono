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

        // paginateで取得する
        $collections = $model::paginate(2);

        return $collections;
    }
}
