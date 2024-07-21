<?php

namespace App\ValueObjects\StoreStaff;

use App\ValueObjects\Staff\Id as OriginalStaffId;

class StaffId extends OriginalStaffId
{
    public const NAME = 'staff_id';

    public const LABEL = 'STAFF_ID';

    protected bool $primaryKey = false;
}
