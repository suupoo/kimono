<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\ValueObject;

class CreatedAt extends ValueObject
{
    public const NAME = 'created_at';

    public const LABEL = '作成日時';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'datetime';

    protected bool $required = false; // DB Nullable

}
