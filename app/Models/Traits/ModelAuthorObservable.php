<?php

namespace App\Models\Traits;

use App\Observers\ModelAuthorObserver;

trait ModelAuthorObservable
{
    public static function bootModelAuthorObservable(): void
    {
        self::observe(ModelAuthorObserver::class);
    }
}
