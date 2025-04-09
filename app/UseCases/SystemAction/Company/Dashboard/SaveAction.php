<?php

namespace App\UseCases\SystemAction\Company\Dashboard;

use App\UseCases\ResourceAction\ListAction as BaseAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Class CreateAction
 * 保存アクション
 */
class SaveAction extends BaseAction
{
    public function __invoke(Request $request, string $model, array $attributes = []) : RedirectResponse
    {
        try {
            $mSystemCompany = Auth::user()->systemCompanies->first();

            // リソースに紐づいたモデル
            $systemCompanyDashboard = (new $model)
                ->firstOrNew([
                    'm_system_company_id' => $mSystemCompany->id,
                ]);

            // バリデーション
            $validator = Validator::make($request->all(), [
                'dashboard' => "nullable|string",
            ]);

            if ($validator->fails()) {
                // バリデーションエラー
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $systemCompanyDashboard->dashboard = $request->input('dashboard', '');;
            if($systemCompanyDashboard->isDirty()){
                // 変更がある場合は保存
                $systemCompanyDashboard->save();
            }

            return redirect()->route('me.company.index')
                ->with('message', '保存しました。');

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
