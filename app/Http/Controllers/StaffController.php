<?php

namespace App\Http\Controllers;

use App\Models\Staff as ResourceModel; // モデル紐付け
use App\UseCases\StaffAction\CreateAction;
use App\UseCases\StaffAction\DeleteAction;
use App\UseCases\StaffAction\ListAction;
use App\UseCases\StaffAction\UpdateAction;
use App\ValueObjects\Staff\Code;
use App\ValueObjects\Staff\JoinDate;
use App\ValueObjects\Staff\Name;
use App\ValueObjects\Staff\QuitDate;
use App\ValueObjects\Staff\Tel;
use App\ValueObjects\Staff\Id;
use App\ValueObjects\Staff\StaffPosition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class StaffController extends ResourceController
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
                new Code,
                new Tel,
                new JoinDate,
                new QuitDate,
                new StaffPosition,
            ]),
            'searchable' => new Collection([
                new Id,
                new Name,
                new Code,
                new Tel,
                new JoinDate,
                new QuitDate,
                new StaffPosition,
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
        $view = $this->model->getTable().'.index'; // staffs/index.blade.php

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
        $view = $model->getTable().'.create'; // staffs/create.blade.php

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
        $view = $model->getTable().'.edit'; // staffs/edit.blade.php

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
        $view = $model->getTable().'.show'; // staffs/show.blade.php

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
