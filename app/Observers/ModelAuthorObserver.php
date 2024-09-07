<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class ModelAuthorObserver
{
    public function creating($model)
    {
        if ($model->authors) {
            $model->created_user = Auth::user()->id;
        }
    }

    public function updating($model)
    {
        if ($model->authors) {
            if ($model->isDirty()) {
                $model->updated_user = Auth::user()->id;
            }
        }
    }

    public function saving($model)
    {
        if ($model->authors) {
            self::creating($model);
            self::updating($model);
        }
    }
}
