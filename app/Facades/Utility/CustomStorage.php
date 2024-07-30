<?php

namespace App\Facades\Utility;

use Illuminate\Support\Facades\Facade;

class CustomStorage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'custom-storage';
    }
}
