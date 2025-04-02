<?php

namespace App\Http\Controllers;

use App\Models\MSystemFeature as FeatureResourceModel;
use App\UseCases\SystemAction\Feature\SaveAction as FeatureSaveAction;
use App\UseCases\SystemAction\Feature\ListAction as FeatureListAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemController extends Controller
{
    public function listFeature(Request $request, FeatureListAction $action): View
    {
        $model = new FeatureResourceModel;
        $items = $action($request, FeatureResourceModel::class);

        return view('system.features.list', compact('model', 'items'));
    }

    public function saveFeature(Request $request, FeatureSaveAction $action): RedirectResponse
    {
        return $action($request, FeatureResourceModel::class);
    }
}
