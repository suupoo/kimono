<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\ValueObject;

class IsVerified extends ValueObject
{
    public const NAME = 'is_verified';

    public const LABEL = '認証済みフラグ';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'boolean';

    protected bool $required = false; // DB Not Nullable
}
