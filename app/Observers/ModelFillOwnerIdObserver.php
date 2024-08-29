<?php

namespace App\Observers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ModelFillOwnerIdObserver
{
    public function creating($model)
    {
        // システムユーザ以外の場合は自社のデータのみ取得
        if (! Auth::user()->isSystem()) {
            $company = Auth::user()->systemCompanies->first(); // todo: 複数企業に対応
            $model->owner_system_company = $company?->id;

            // シーケンス番号の生成
            $sequenceNo = $this->createSequenceNo(get_class($model));
            if (! $sequenceNo) {
                throw new Exception('タグ生成に失敗しました。');
            }

            $model->owner_sequence_no = $sequenceNo;
        }
    }

    /**
     * 新規登録時のNo生成
     */
    private function createSequenceNo(string $modelClass): string|false
    {
        try {
            $entity = new $modelClass;
            $sequenceNo = $entity->withTrashed()->max('owner_sequence_no') + 1;
            $uniqueCheck = $entity::query()->where('owner_sequence_no', $sequenceNo)->first();
            if ($uniqueCheck) {
                throw new Exception('タグが重複しています。');
            }

            return $sequenceNo;

        } catch (Exception $e) {
            Log::error('タグ生成に失敗しました。');
            Log::error($e->getMessage());

            return false;
        }
    }
}
