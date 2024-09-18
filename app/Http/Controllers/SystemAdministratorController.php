<?php

namespace App\Http\Controllers;

use App\Models\MSystemAdministrator as ResourceModel;
use App\UseCases\SystemAction\Administrator\CreateAction as CreateAction;
use App\UseCases\SystemAction\Administrator\DeleteAction as DeleteAction;
use App\UseCases\SystemAction\Administrator\ListAction as ListAction;
use App\UseCases\SystemAction\Administrator\SystemAdministratorListAction;
use App\UseCases\SystemAction\Administrator\SystemAdministratorSaveAction;
use App\UseCases\SystemAction\Administrator\UpdateAction as UpdateAction;
use App\ValueObjects\Column\Master\Administrator\Email;
use App\ValueObjects\Column\Master\Administrator\EndAt;
use App\ValueObjects\Column\Master\Administrator\Id;
use App\ValueObjects\Column\Master\Administrator\Name;
use App\ValueObjects\Column\Master\Administrator\StartAt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

// モデル紐付け

class SystemAdministratorController extends ResourceController
{
    protected ResourceModel $model;

    protected ?string $prefix = 'system.administrators';

    /**
     * 一覧表示<index>画面でのデフォルトの一覧表示条件設定
     * @return array
     */
    public function defaultSortParameters(): array
    {
        return [
            'sort'  => 'id',
            'order' => 'asc',
            'rows'  => config('custom.paginate.default'),
        ];
    }

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
                new StartAt,
                new EndAt,
            ]),
            'searchable' => new Collection([
                new Id,
                new Name,
                new Email,
                new StartAt,
                new EndAt,
            ]),
            'paginate' => request()->get('rows', config('custom.paginate.default')),
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
        $prefix = $this->prefix;

        // ソート順番がない場合はリダイレクト
        $checkSortParameter = parent::checkSortParameter($request);
        if (! empty($checkSortParameter)) {
            return redirect()->route("$prefix.index", $checkSortParameter);
        }

        $model = new $this->model;
        $view = "$prefix.index"; // administrators/index.blade.php

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
            ? $this->model->findOrFail(request()->get('copy'))  // 複製
            : (new $this->model);                               // 新規作成
        $view = "$prefix.create"; // system/administrators/create.blade.php

        return view($view, compact('model', 'prefix'));
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
        $view = "$prefix.edit"; // administrators/edit.blade.php

        return view($view, compact('model', 'prefix'));
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
        $view = "$prefix.show"; // administrators/show.blade.php

        return view($view, compact('model', 'prefix'));
    }

    /**
     * 削除処理
     */
    public function destroy(Request $request, string $id, DeleteAction $action): RedirectResponse
    {
        $action->setPrefix($this->prefix); // プレフィックス設定

        return $action($request, ResourceModel::class);
    }

    /***
     *
     * これ以降にリソース以外の機能を追加する
     *
     */

    public function companies(Request $request, string $id, SystemAdministratorListAction $action)
    {
        $actionData = $action($request, ResourceModel::class);

        $model = $actionData['systemAdministrator'];
        $systemAdministratorsCompaniesList = $actionData['systemAdministratorsCompaniesList'];
        $systemCompaniesList = $actionData['systemCompaniesList'];
        $prefix = $this->prefix;
        $view = $prefix.'.companies.list';

        return view($view, compact('model', 'systemAdministratorsCompaniesList', 'systemCompaniesList', 'prefix'));
    }

    /**
     * @throws \Exception
     */
    public function saveCompanies(Request $request, string $id, SystemAdministratorSaveAction $action): RedirectResponse
    {
        $action->setPrefix($this->prefix); // プレフィックス設定

        return $action($request, ResourceModel::class);
    }
}
