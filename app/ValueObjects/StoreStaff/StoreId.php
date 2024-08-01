<?php

namespace App\ValueObjects\StoreStaff;

use App\ValueObjects\Store\Id as OriginalStoreId;

class StoreId extends OriginalStoreId
{
    public const NAME = 'store_id';

    public const LABEL = 'STORE_ID';

    protected bool $primaryKey = false;
}
