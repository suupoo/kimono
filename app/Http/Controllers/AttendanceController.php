<?php

namespace App\Http\Controllers;

use App\Models\Attendance as ResourceModel;
use App\Models\Staff;
use App\UseCases\AttendanceAction\CreateAction;
use App\UseCases\AttendanceAction\DeleteAction;
use App\UseCases\AttendanceAction\ListAction;
use App\UseCases\AttendanceAction\UpdateAction;
use App\ValueObjects\Column\Attendance\CreatedAt;
use App\ValueObjects\Column\Attendance\StaffId;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// モデル紐付け
// エクスポートリソース紐付け

class AttendanceController extends ResourceController
{
    protected ResourceModel $model;

    /**
     * 一覧表示<index>画面での一覧表示条件設定
     */
    protected function initListConditions(): array
    {
        return [
            'sortable' => new Collection([
                new CreatedAt,
            ]),
            'searchable' => new Collection([
                new StaffId,
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
        // ソート順番がない場合はリダイレクト
        $checkSortParameter = parent::checkSortParameter($request);
        if (! empty($checkSortParameter)) {
            return redirect()->route($this->model->getTable().'.index', $checkSortParameter);
        }

        $model = new $this->model;
        $view = $this->model->getTable().'.index'; // attendances/index.blade.php

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
        if(request()->has('staff_id') ){
            // ログインユーザーの所属企業に紐づくスタッフのみ表示
            $userSystemCompanies = Auth::user()?->systemCompanies->pluck('id');
            $hasUserSystemCompanies = Staff::where('id', request()->get('staff_id'))
                ->whereIn('owner_system_company', $userSystemCompanies)
                ->exists();
            if (! $hasUserSystemCompanies) abort(404); // 404エラー
        }

        $model = (request()->has('copy'))
            ? $this->model->findOrFail(request()->get('copy'))  // 複製
            : (new $this->model);                               // 新規作成
        $view = $model->getTable().'.create'; // attendances/create.blade.php

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
        $view = $model->getTable().'.edit'; // attendances/edit.blade.php

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
        $view = $model->getTable().'.show'; // attendances/show.blade.php

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
