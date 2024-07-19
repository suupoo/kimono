<?php

namespace App\Http\Controllers;

use App\Models\Administrator as ResourceModel;
use App\UseCases\MeAction\ListAction;
use App\UseCases\MeAction\SaveAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function list(Request $request, ListAction $action)
    {
        $model = $action($request, ResourceModel::class);

        return view('me.list', compact('model'));
    }

    public function save(Request $request, SaveAction $action) : RedirectResponse
    {
        return $action($request, ResourceModel::class);
    }
}
