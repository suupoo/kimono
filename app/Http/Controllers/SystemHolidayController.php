<?php

namespace App\Http\Controllers;

use App\Models\MSystemHolidays as ResourceModel;
use App\UseCases\SystemAction\Holiday\CreateAction;
use App\UseCases\SystemAction\Holiday\DeleteAction;
use App\UseCases\SystemAction\Holiday\ListAction;
use App\UseCases\SystemAction\Holiday\UpdateAction;
use App\ValueObjects\Column\Master\Holiday\Date;
use App\ValueObjects\Column\Master\Holiday\Locale;
use App\ValueObjects\Column\Master\Holiday\Name;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

// モデル紐付け

class SystemHolidayController extends ResourceController
{
    protected ResourceModel $model;

    protected ?string $prefix = 'system.holidays';

    /**
     * 一覧表示<index>画面でのデフォルトの一覧表示条件設定
     * @return array
     */
    public function defaultSortParameters(): array
    {
        return [
            'sort'  => 'date',
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
                new Name,
                new Date,
                new Locale
            ]),
            'searchable' => new Collection([
                new Name,
                new Date,
                new Locale
            ]),
            'paginate' => request()->get('rows', config('custom.paginate.default')),
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
        $view = "$prefix.index"; // system/holidays/index.blade.php

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
        $view = "$prefix.create"; // system/holidays/create.blade.php

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
        $view = "$prefix.edit"; // system/holidays/edit.blade.php

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
        $view = "$prefix.show"; // system/holidays/show.blade.php

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
}
