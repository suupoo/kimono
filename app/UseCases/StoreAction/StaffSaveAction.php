<?php

namespace App\UseCases\StoreAction;

use App\Models\Staff;
use App\Models\StoreStaffs;
use App\UseCases\Action;
use App\ValueObjects\Staff\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffSaveAction extends Action
{
    /**
     * Handle the incoming request.
     *
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model, array $attributes = []): RedirectResponse
    {
        try {
            $store = (new $model)
                ->with('staffs')
                ->findOrFail($request->id);

            $validator = Validator::make($request->all(), [
                'staffs' => 'nullable|array',
                'staffs.*' => (new Id)->rules(),
            ]);

            if ($validator->fails()) {
                return redirect()->route($store->getTable().'.staffs.list', ['id' => $store->id])
                    ->withErrors($validator->errors())
                    ->withInput();
            }

            $staffList = Staff::all();

            foreach ($staffList as $staff) {
                $record = StoreStaffs::where('store_id', $store->id)
                    ->where('staff_id', $staff->id)
                    ->first();
                if ($record) {
                    // すでに登録されている場合
                    if (! $request->staffs || ! in_array($staff->id, $request->staffs)) {
                        // チェックが外れている場合は削除
                        $record->delete();
                    }
                } else {
                    // 未登録の場合
                    if ($request->staffs && in_array($staff->id, $request->staffs)) {
                        // チェックが入っている場合は登録
                        $storeStaff = new StoreStaffs();
                        $storeStaff->store_id = $store->id;
                        $storeStaff->staff_id = $staff->id;
                        $storeStaff->save();
                    }
                }
            }

            return redirect()->route($store->getTable().'.staffs.list', ['id' => $store->id]);

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
