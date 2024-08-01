<?php

namespace App\Models\Traits;

use App\Observers\ModelFillOwnerIdObserver;

trait ModelFillOwnerIdObservable
{
    public static function bootModelFillOwnerIdObservable(): void
    {
        self::observe(ModelFillOwnerIdObserver::class);
    }
}
