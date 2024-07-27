<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class ModelFillOwnerIdObserver
{
    public function creating($model)
    {
        // システムユーザ以外の場合は自社のデータのみ取得
        if(!Auth::user()->is_system){
            $company = Auth::user()->systemCompanies->first();// todo: 複数企業に対応
            $model->owner_system_company = $company?->id;
        }
    }
}
