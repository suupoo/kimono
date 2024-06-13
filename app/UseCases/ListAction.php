<?php

namespace App\UseCases;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAction
{
    protected $defaultPaginate = 10;

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

        // ソート条件があれば取得
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        // 検索条件を取得する
        $searchConditions = $request->except(['sort', 'order']);

        // 検索可能なカラムを取得する
        $searchable = $attributes['searchable'] ?? new Collection();

        // 検索条件を設定する
        $query = $model->query();
        $searchable->each(function ($item) use ($query, $searchConditions) {
            if (array_key_exists($item->column(), $searchConditions)) {
                $column = $item->column();
                $columnType = $item->type();

                if ($columnType === 'number') {
                    // 数値の場合は完全一致
                    $query->where($column, $searchConditions[$column]);
                } else {
                    // 文字列の場合は部分一致
                    $query->where($column, 'like', "%$searchConditions[$column]%");
                }
            }
        });

        // ソート条件を設定
        $query->orderBy($sort, $order);

        // paginateで取得する
        $paginate = $attributes['paginate'] ?? $this->defaultPaginate;
        $collections = $query->paginate($paginate);

        return $collections;
    }
}
