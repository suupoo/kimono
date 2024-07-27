<?php

namespace App\UseCases\SystemAction\Administrator;

use App\Models\MSystemAdministratorCompany;
use App\Models\MSystemCompany;
use App\UseCases\Action;
use App\ValueObjects\Master\Company\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\UseCases\Traits\PrefixSettable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SystemAdministratorSaveAction extends Action
{
    use PrefixSettable;

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param string $model
     * @param array $attributes
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model, array $attributes = []) : RedirectResponse
    {
        try {
            $systemAdministrator = (new $model)
                ->with('systemCompanies')
                ->findOrFail($request->id);

            $validator = Validator::make($request->all(), [
                'system_companies' => 'nullable|array',
                'system_companies.*' => (new Id)->rules(),
            ]);

            if($validator->fails()){
                return redirect()->route($this->prefix.'.companies.list', ['id' => $systemAdministrator->id])
                    ->withErrors($validator->errors())
                    ->withInput();
            }

            foreach (MSystemCompany::all() as $systemCompany) {
                $record = MSystemAdministratorCompany::where('system_administrator', $systemAdministrator->id)
                    ->where('system_company', $systemCompany->id)
                    ->first();
                if($record){
                    // すでに登録されている場合
                    if (!$request->system_companies || !in_array($systemCompany->id, $request->system_companies)) {
                        // チェックが外れている場合は削除
                        $record->delete();
                    }
                }else{
                    // 未登録の場合
                    if ($request->system_companies && in_array($systemCompany->id, $request->system_companies)) {
                        // チェックが入っている場合は登録
                        $storeStaff = new MSystemAdministratorCompany;
                        $storeStaff->system_administrator = $systemAdministrator->id;
                        $storeStaff->system_company = $systemCompany->id;
                        $storeStaff->save();
                    }
                }
            }

            return redirect()->route($this->prefix.'.companies.list', ['id' => $systemAdministrator->id]);

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
