<?php

namespace App\UseCases\StoreAction;

use App\Models\Staff;
use App\UseCases\Action;
use Illuminate\Http\Request;

class StaffListAction extends Action
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
            $store = (new $model)
                ->with('staffs')
                ->findOrFail($request->id);

            $storeStaffList = $store->staffs;
            $staffList = Staff::all();

            // 値を返す
            return compact('store', 'storeStaffList', 'staffList');

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
