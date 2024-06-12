<?php

namespace App\Http\Controllers;

use App\Models\Customer as ResourceModel; // モデル紐付け
use App\UseCases\CreateAction;
use App\UseCases\ListAction;
use App\ValueObjects\Customer\PostCode;
use \App\ValueObjects\Customer\Prefecture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class CustomerController
{
    protected ResourceModel $model;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->model = new ResourceModel;
    }

    public function index(Request $request, ListAction $action): View|RedirectResponse
    {
        $model = $this->model;
        $items = new LengthAwarePaginator([], 0, 1, 1);
        $view = $this->model->getTable().'.index'; // customers/index.blade.php
        $listConditions = [
            // ソート可能なカラム
            'sortable' => [
                '*'
                // PostCode::NAME,
                // Prefecture::NAME,
            ],
            // 検索可能なカラム
            'searchable' => [
                '*'
                // PostCode::NAME,
                // Prefecture::NAME,
            ],
        ];

        try {
            $items = $action($request, ResourceModel::class, $listConditions);
        } catch (\Exception $e) {
            // ログを出す;
        }

        return view($view, compact('model', 'items', 'listConditions'));
    }

    public function create(): View
    {
        $model = new $this->model;
        $view = $model->getTable().'.create'; // customers/create.blade.php

        return view($view, compact('model'));
    }

    public function store(Request $request, CreateAction $action): RedirectResponse
    {
        $model = new $this->model;
        $redirect = $model->getTable().'.create'; // customers/index

        try {
            $action($request, ResourceModel::class);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route($redirect);
    }
}
