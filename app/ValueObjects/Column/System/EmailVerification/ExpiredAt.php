<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\ValueObject;

class ExpiredAt extends ValueObject
{
    public const NAME = 'expired_at';

    public const LABEL = '有効期限';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'datetime';

    protected bool $required = false; // DB Nullable
}
