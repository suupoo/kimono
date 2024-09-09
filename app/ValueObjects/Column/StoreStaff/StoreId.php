<?php

namespace App\ValueObjects\Column\StoreStaff;

use App\ValueObjects\Column\Store\Id as OriginalStoreId;

class StoreId extends OriginalStoreId
{
    public const NAME = 'store_id';

    public const LABEL = 'STORE_ID';

    protected bool $primaryKey = false;
}
