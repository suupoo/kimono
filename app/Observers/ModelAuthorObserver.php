<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class ModelAuthorObserver
{
    public function creating($model)
    {
        $model->created_user = Auth::user()->id;
    }

    public function updating($model)
    {
        if ($model->isDirty()) {
            $model->updated_user = Auth::user()->id;
        }
    }

    public function saving($model)
    {
        self::creating($model);
        self::updating($model);
    }
}
