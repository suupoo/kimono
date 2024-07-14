<?php

namespace App\Facades\Utility;

use Illuminate\Support\Facades\Facade;
class CustomForm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'custom-form';
    }
}
