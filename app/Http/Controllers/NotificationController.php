<?php

namespace App\Http\Controllers;

use App\Models\Notification as ResourceModel; // モデル紐付け
use App\UseCases\NotificationAction\ListAction;
use App\UseCases\NotificationAction\CreateAction;
use App\UseCases\NotificationAction\DeleteAction;
use App\UseCases\NotificationAction\UpdateAction;
use App\ValueObjects\Notification\Id;
use App\ValueObjects\Notification\PublishAt;
use App\ValueObjects\Notification\Status;
use App\ValueObjects\Notification\Title;
use App\ValueObjects\Notification\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class NotificationController extends ResourceController
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
                new Title,
                new PublishAt,
                new Status,
                new Type,
            ]),
            'searchable' => new Collection([
                new Id,
                new Title,
                new PublishAt,
                new Status,
                new Type,
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
        $view = $this->model->getTable().'.index'; // notifications/index.blade.php

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
        $view = $model->getTable().'.create'; // notifications/create.blade.php

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
        $view = $model->getTable().'.edit'; // notifications/edit.blade.php

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
        $view = $model->getTable().'.show'; // notifications/show.blade.php

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
