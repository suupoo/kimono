<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class OwnerScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // システムユーザ以外の場合は自社のデータのみ取得
        if (! Auth::user()->isSystem()) {
            $company = Auth::user()->systemCompanies->first(); // todo: 複数企業に対応
            $builder->where('owner_system_company', $company->id);
        }
    }
}
