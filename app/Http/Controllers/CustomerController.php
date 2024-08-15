<?php

namespace App\Http\Controllers;

use App\Models\Customer as ResourceModel; // モデル紐付け
use App\UseCases\CustomerAction\CreateAction;
use App\UseCases\CustomerAction\DeleteAction;
use App\UseCases\CustomerAction\ListAction;
use App\UseCases\CustomerAction\UpdateAction;
use App\ValueObjects\Customer\Address1;
use App\ValueObjects\Customer\Address2;
use App\ValueObjects\Customer\CustomerName;
use App\ValueObjects\Customer\OwnerSequenceNo;
use App\ValueObjects\Customer\PostCode;
use App\ValueObjects\Customer\Prefecture;
use App\ValueObjects\Customer\Tags;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CustomerController extends ResourceController
{
    protected ResourceModel $model;

    /**
     * 一覧表示<index>画面での一覧表示条件設定
     */
    protected function initListConditions(): array
    {
        return [
            'sortable' => new Collection([
                new OwnerSequenceNo,
                new PostCode,
                new Prefecture,
                new Address1,
                new Address2,
            ]),
            'searchable' => new Collection([
                new OwnerSequenceNo,
                new CustomerName,
                new PostCode,
                new Prefecture,
                new Address1,
                new Address2,
                new Tags,
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
        $view = $this->model->getTable().'.index'; // customers/index.blade.php

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
        $model = (request()->has('copy'))
            ? $this->model->findOrFail(request()->get('copy'))  // 複製
            : (new $this->model);                               // 新規作成
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
