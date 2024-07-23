<?php

namespace App\Http\Controllers;

use App\Models\MSystemCompany as ResourceModel; // モデル紐付け
use App\UseCases\CompanyAction\CreateAction;
use App\UseCases\CompanyAction\DeleteAction;
use App\UseCases\CompanyAction\ListAction;
use App\UseCases\CompanyAction\UpdateAction;
use App\ValueObjects\Company\Id;
use App\ValueObjects\Company\Name;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SystemCompanyController extends ResourceController
{
    protected ResourceModel $model;
    protected ?string $prefix = 'system.companies';

    /**
     * 一覧表示<index>画面での一覧表示条件設定
     */
    protected function initListConditions(): array
    {
        return [
            'sortable' => new Collection([
                new Id,
                new Name,
            ]),
            'searchable' => new Collection([
                new Id,
                new Name,
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
        $prefix = $this->prefix;

        // ソート順番がない場合はリダイレクト
        $checkSortParameter = parent::checkSortParameter($request);
        if (! empty($checkSortParameter)) {
            return redirect()->route("$prefix.index", $checkSortParameter);
        }

        $model = new $this->model;
        $view = "$prefix.index"; // companies/index.blade.php

        // 検索結果の取得
        $listConditions = $this->initListConditions();

        $action->setPrefix($this->prefix); // プレフィックス設定
        $items = $action($request, ResourceModel::class, $listConditions);

        return view($view, compact('model', 'items', 'listConditions', 'prefix'));
    }

    /**
     * 新規登録画面表示
     */
    public function create(): View
    {
        $prefix = $this->prefix;
        $model = (request()->has('copy'))
            ?$this->model->findOrFail(request()->get('copy'))  // 複製
            :(new $this->model);                               // 新規作成
        $view = "$prefix.create"; // companies/create.blade.php

        return view($view, compact('model'));
    }

    /**
     * 新規登録処理
     */
    public function store(Request $request, CreateAction $action): RedirectResponse
    {
        $action->setPrefix($this->prefix); // プレフィックス設定
        return $action($request, ResourceModel::class);
    }

    /**
     * 編集画面表示
     */
    public function edit(string $id): View
    {
        $prefix = $this->prefix;
        $model = $this->model->findOrFail($id);
        $view = "$prefix.edit"; // companies/edit.blade.php

        return view($view, compact('model'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, int $id, UpdateAction $action): RedirectResponse
    {
        $action->setPrefix($this->prefix); // プレフィックス設定
        return $action($request, ResourceModel::class);
    }

    /**
     * 詳細画面表示
     */
    public function show(string $id): View
    {
        $prefix = $this->prefix;
        $model = $this->model->findOrFail($id);
        $view = "$prefix.show"; // companies/show.blade.php

        return view($view, compact('model'));
    }

    /**
     * 削除処理
     */
    public function destroy(Request $request, string $id, DeleteAction $action): RedirectResponse
    {
        $action->setPrefix($this->prefix); // プレフィックス設定
        return $action($request, ResourceModel::class);
    }
}
