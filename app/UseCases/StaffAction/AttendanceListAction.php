<?php

namespace App\UseCases\StaffAction;

use App\Models\Attendance;
use App\UseCases\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceListAction extends Action
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
            $staff = (new $model)
                ->with('attendances')
                ->findOrFail($request->id);

            $staffAttendanceList = $staff->attendances;
            $relationModel = new Attendance; // App\Models\Attendance

            // 値を返す
            return compact('staff', 'staffAttendanceList', 'relationModel');

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
