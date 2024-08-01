<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class ModelAuthorObserver
{
    public function creating($model)
    {
        if(property_exists($model, 'created_user')){
            $model->created_user = Auth::user()->id;
        }
    }

    public function updating($model)
    {
        if(property_exists($model, 'updated_user')){
            $model->updated_user = Auth::user()->id;
        }
    }

    public function saving($model)
    {
        if(property_exists($model, 'updated_user')){
            $model->updated_user = Auth::user()->id;
        }
        if(property_exists($model, 'created_user') && !$model->created_user){
            $model->created_user = Auth::user()->id;
        }
    }
}
