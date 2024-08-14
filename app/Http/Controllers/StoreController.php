<?php

namespace App\Http\Controllers;

use App\Models\Store as ResourceModel; // モデル紐付け
use App\UseCases\StoreAction\CreateAction;
use App\UseCases\StoreAction\DeleteAction;
use App\UseCases\StoreAction\ListAction;
use App\UseCases\StoreAction\StaffListAction;
use App\UseCases\StoreAction\StaffSaveAction;
use App\UseCases\StoreAction\UpdateAction;
use App\ValueObjects\Staff\OwnerSequenceNo;
use App\ValueObjects\Store\Address1;
use App\ValueObjects\Store\Address2;
use App\ValueObjects\Store\PostCode;
use App\ValueObjects\Store\Prefecture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class StoreController extends ResourceController
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
        $view = $this->model->getTable().'.index'; // stores/index.blade.php

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
            ?$this->model->findOrFail(request()->get('copy'))  // 複製
            :(new $this->model);                               // 新規作成
        $view = $model->getTable().'.create'; // stores/create.blade.php

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
        $view = $model->getTable().'.edit'; // stores/edit.blade.php

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
        $view = $model->getTable().'.show'; // stores/show.blade.php

        return view($view, compact('model'));
    }

    /**
     * 削除処理
     */
    public function destroy(Request $request, string $id, DeleteAction $action): RedirectResponse
    {
        return $action($request, ResourceModel::class);
    }

    /***
     *
     * これ以降にリソース以外の機能を追加する
     *
     */

    /**
     * @param Request $request
     * @param string $id
     * @param StaffListAction $action
     * @return View
     * @throws \Exception
     */
    public function staffs(Request $request, string $id, StaffListAction $action): View
    {
        $actionData = $action($request, ResourceModel::class);

        $model = $actionData['store'];
        $storeStaffList = $actionData['storeStaffList'];
        $staffList = $actionData['staffList'];
        $view = $model->getTable().'.staffs.list'; // stores/staffs/list.blade.php

        return view($view, compact('model', 'storeStaffList', 'staffList'));
    }

    /**
     * @param Request $request
     * @param string $id
     * @param StaffSaveAction $action
     * @return RedirectResponse
     * @throws \Exception
     */
    public function saveStaffs(Request $request, string $id, StaffSaveAction $action): RedirectResponse
    {
        return $action($request, ResourceModel::class);
    }
}
