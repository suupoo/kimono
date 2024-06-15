<?php

namespace App\Http\Controllers;

use App\Models\Customer as ResourceModel; // モデル紐付け
use App\UseCases\CreateAction;
use App\UseCases\ListAction;
use App\ValueObjects\Customer\Address1;
use App\ValueObjects\Customer\Id;
use App\ValueObjects\Customer\PostCode;
use \App\ValueObjects\Customer\Prefecture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class CustomerController
{
    protected ResourceModel $model;

    /**
     * 一覧表示<index>画面での一覧表示条件設定
     * @return array
     */
    private function initListConditions(): array
    {
        return [
            'sortable' => new Collection([
                new Id,
                new PostCode,
                new Prefecture,
                new Address1,
            ]),
            'searchable' => new Collection([
                new Id,
                new PostCode,
                new Prefecture,
                new Address1,
            ]),
            'paginate' => 10,
        ];
    }

    public function __construct()
    {
        // $this->middleware('auth');
        $this->model = new ResourceModel;
    }

    public function index(Request $request, ListAction $action): View|RedirectResponse
    {
        // ソート順番がない場合はリダイレクト
        $redirectParam = [];
        if (!$request->get('sort')) {
            $redirectParam['sort'] = 'id';
        }
        if (!$request->get('order')) {
            $redirectParam['order'] = 'asc';
        }
        if (!empty($redirectParam)){
            return redirect()->route($this->model->getTable().'.index',$redirectParam);
        }

        $model = $this->model;
        $items = new LengthAwarePaginator([], 0, 1, 1);
        $view = $this->model->getTable().'.index'; // customers/index.blade.php
        $listConditions = $this->initListConditions();

        try {
            $items = $action($request, ResourceModel::class, $listConditions);
        } catch (\Exception $e) {
            // ログを出す;
            dd($e);
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

    public function edit(string $id): View
    {
        $model = $this->model->findOrFail($id);
        $view = $model->getTable().'.edit'; // customers/edit.blade.php

        return view($view, compact('model'));
    }

    public function destroy(Request $request, string $id): RedirectResponse
    {
        $model = $this->model->findOrFail($id);
        $redirect = $model->getTable().'.index'; // customers/edit.blade.php
        $search = Crypt::decrypt($request->get('search'));

        try {
            $model->delete();
        } catch (\Exception $e) {
            return redirect()->route($redirect, $search)->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route($redirect, $search);
    }
}
