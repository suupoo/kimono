<?php

namespace App\Http\Controllers;

use App\Models\MSystemFunction as ResourceModel;
use App\UseCases\SystemAction\Function\ListAction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemController extends Controller
{
    public function listFunction(Request $request, ListAction $action): View
    {
        $model = new ResourceModel;
        $items = $action($request, ResourceModel::class);

        return view('system.functions.list', compact('model','items'));
    }

    public function saveFunction(Request $request)
    {

    }
}
