<?php

namespace App\Http\Controllers;

use App\Models\MSystemCompanyDashboard as ResourceModel;
use App\UseCases\SystemAction\Company\Dashboard\ListAction;
use App\UseCases\SystemAction\Company\Dashboard\SaveAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemCompanyDashboardController extends ResourceController
{
    protected ResourceModel $model;

    protected ?string $prefix = 'system.companies';

    public function __construct()
    {
        $this->model = new ResourceModel;
    }

    public function list(Request $request, ListAction $action): View
    {
        $model = $action($request, ResourceModel::class);

        return view('system.companies.dashboard.list', compact('model'));
    }

    public function save(Request $request, SaveAction $action): RedirectResponse
    {
        return $action($request, ResourceModel::class);
    }
}
