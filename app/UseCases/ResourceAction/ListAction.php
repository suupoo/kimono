<?php

namespace App\UseCases\ResourceAction;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListAction extends ResourceAction
{
    /**
     * デフォルトのページネーション数を取得する
     * @return int
     */
    public function defaultPaginate(): int
    {
        return config('app.pagination.default');
    }

    /**
     * Handle the incoming request.
     *
     * @return RedirectResponse|void
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model, array $attributes = [])
    {
        // アクション開始時の処理
        $this->startOfAction($request, $model);

        // リソースに紐づいたモデル
        $model = new $model;

        // ソート条件があれば取得
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        // 検索条件を取得する
        $searchConditions = $request->except(['sort', 'order', 'page']);

        // 検索条件実行前の処理
        $this->prepareSearchCondition($request, $model, [
            'sort' => &$sort,
            'order' => &$order,
            'searchCollection' => &$searchCollection,
        ]);

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

        // ペシネーション数を取得する
        $paginate = $attributes['paginate'] ?? $this->defaultPaginate();

        // 検索実行前の処理
        $this->beforeOfSearch($request, $model, [
            'searchConditions' => &$searchConditions,
            'searchable' => &$searchable,
            'query' => &$query,
            'paginate' => &$paginate,
        ]);

        // 検索実行
        $searchCollection = $query->paginate($paginate)
            ->appends($request->except('page'));

        // 検索実行後の処理
        $this->beforeOfSearch($request, $model, [
            'searchCollection' => &$searchCollection,
        ]);

        // アクション終了時の処理
        $this->endOfAction($request, $model);

        return
            $searchCollection;
    }
}
