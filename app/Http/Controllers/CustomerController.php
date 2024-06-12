<?php

namespace App\Http\Controllers;

use App\Models\Customer as ResourceModel; // モデル紐付け
use App\UseCases\CreateAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController
{
    protected ResourceModel $model;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->model = new ResourceModel;
    }

    public function create(): View
    {
        $model = new $this->model;
        $view = $model->getTable().'.create'; // customers/create.blade.php

        return view($view, compact('model'));
    }

    public function store(Request $request, CreateAction $action): RedirectResponse
    {
        $model = new $this->model;
        $redirect = $model->getTable().'.create'; // customers/index

        try {
            $action($request, ResourceModel::class);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route($redirect);
    }
}
