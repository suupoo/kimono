<?php

namespace App\UseCases\SystemAction\Company\Dashboard;

use App\UseCases\ResourceAction\ListAction as BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class CreateAction
 * 新規登録アクション
 */
class ListAction extends BaseAction
{
    public function __invoke(Request $request, string $model, array $attributes = [])
    {
        try {
            $userCompany = Auth::user()->systemCompanies->first();
            $userCompany->load('dashboards');

            return
                $userCompany->dashboards->first();

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
