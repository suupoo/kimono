<?php

namespace App\Http\Controllers;

use App\Models\MSystemFeature as FeatureResourceModel;
use App\UseCases\SystemAction\Feature\ListAction;
use App\UseCases\SystemAction\Feature\SaveAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemController extends Controller
{
    public function listFeature(Request $request, ListAction $action): View
    {
        $model = new FeatureResourceModel;
        $items = $action($request, FeatureResourceModel::class);

        return view('system.features.list', compact('model', 'items'));
    }

    public function saveFeature(Request $request, SaveAction $action): RedirectResponse
    {
        return $action($request, FeatureResourceModel::class);
    }
}
