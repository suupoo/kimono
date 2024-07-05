<?php

namespace App\Http\Controllers;

use App\Models\Administrator as ResourceModel; // モデル紐付け
use App\UseCases\AdministratorAction\CreateAction as CreateAction;
use App\UseCases\AdministratorAction\DeleteAction as DeleteAction;
use App\UseCases\AdministratorAction\ListAction as ListAction;
use App\UseCases\AdministratorAction\UpdateAction as UpdateAction;
use App\ValueObjects\Administrator\Email;
use App\ValueObjects\Administrator\Id;
use App\ValueObjects\Administrator\Name;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AdministratorController extends ResourceController
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
                new Name,
                new Email,
            ]),
            'searchable' => new Collection([
                new Id,
                new Name,
                new Email,
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
     * 一覧表示
     */
    public function index(Request $request, ListAction $action): View|RedirectResponse
    {
        // ソート順番がない場合はリダイレクト
        $checkSortParameter = parent::checkSortParameter($request);
        if (! empty($checkSortParameter)) {
            return redirect()->route($this->model->getTable().'.index', $checkSortParameter);
        }

        $model = new $this->model;
        $view = $this->model->getTable().'.index'; // administrators/index.blade.php

        // 検索結果の取得
        $listConditions = $this->initListConditions();
        $items = $action($request, ResourceModel::class, $listConditions);

        return view($view, compact('model', 'items', 'listConditions'));
    }

    /**
     * 新規登録画面表示
     */
    public function create(): View
    {
        $model = new $this->model;
        $view = $model->getTable().'.create'; // administrators/create.blade.php

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
        $view = $model->getTable().'.edit'; // administrators/edit.blade.php

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
        $view = $model->getTable().'.show'; // administrators/show.blade.php

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
