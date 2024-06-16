<?php

namespace App\Http\Controllers;

use App\Models\Customer as ResourceModel; // モデル紐付け
use App\UseCases\CustomerAction\CreateAction;
use App\UseCases\CustomerAction\DeleteAction;
use App\UseCases\CustomerAction\ListAction;
use App\UseCases\CustomerAction\UpdateAction;
use App\ValueObjects\Customer\Address1;
use App\ValueObjects\Customer\Address2;
use App\ValueObjects\Customer\Id;
use App\ValueObjects\Customer\PostCode;
use App\ValueObjects\Customer\Prefecture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected ResourceModel $model;

    /**
     * 一覧表示<index>画面での一覧表示条件設定
     */
    protected function initListConditions(): array
    {
        return [
            'sortable' => new Collection([
                new Id,
                new PostCode,
                new Prefecture,
                new Address1,
                new Address2,
            ]),
            'searchable' => new Collection([
                new Id,
                new PostCode,
                new Prefecture,
                new Address1,
                new Address2,
            ]),
            'paginate' => 10,
        ];
    }

    public function __construct()
    {
        // $this->middleware('auth');
        $this->model = new ResourceModel;
    }

    /**
     * 一覧表示前処理
     */
    private function preCheckForIndex(Request $request): void
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

    /**
     * 一覧表示
     */
    public function index(Request $request, ListAction $action): View|RedirectResponse
    {
        // ソート順番がない場合はリダイレクト
        $this->preCheckForIndex($request);

        // 一覧表示
        $model = new $this->model;
        $view = $this->model->getTable().'.index'; // customers/index.blade.php
        $listConditions = $this->initListConditions();

        try {
            $items = $action($request, ResourceModel::class, $listConditions);
        } catch (\Exception $e) {
            // 検索条件を初期化
            $items = new LengthAwarePaginator([], 0, 1, 1);
        }

        return view($view, compact('model', 'items', 'listConditions'));
    }

    /**
     * 新規登録画面表示
     */
    public function create(): View
    {
        $model = new $this->model;
        $view = $model->getTable().'.create'; // customers/create.blade.php

        return view($view, compact('model'));
    }

    /**
     * 新規登録処理
     */
    public function store(Request $request, CreateAction $action): RedirectResponse
    {
        return $action($request, ResourceModel::class);
    }

    /**
     * 編集画面表示
     */
    public function edit(string $id): View
    {
        $model = $this->model->findOrFail($id);
        $view = $model->getTable().'.edit'; // customers/edit.blade.php

        return view($view, compact('model'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, int $id, UpdateAction $action): RedirectResponse
    {
        return $action($request, ResourceModel::class);
    }

    /**
     * 詳細画面表示
     */
    public function show(string $id): View
    {
        $model = $this->model->findOrFail($id);
        $view = $model->getTable().'.show'; // customers/show.blade.php

        return view($view, compact('model'));
    }

    /**
     * 削除処理
     */
    public function destroy(Request $request, string $id, DeleteAction $action): RedirectResponse
    {
        return $action($request, ResourceModel::class);
    }
}
