<?php

namespace App\UseCases\SystemAction\Administrator;

use App\Models\MSystemCompany;
use App\UseCases\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SystemAdministratorListAction extends Action
{
    /**
     * Handle the incoming request.
     *
     * @return array
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model, array $attributes = [])
    {
        try {
            $systemAdministrator = (new $model)
                ->with('systemCompanies')
                ->findOrFail($request->id);

            $systemAdministratorsCompaniesList = $systemAdministrator->systemCompanies;
            $systemCompaniesList = MSystemCompany::all();

            // 値を返す
            return compact('systemAdministrator', 'systemAdministratorsCompaniesList', 'systemCompaniesList');

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
