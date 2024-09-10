<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\ValueObject;

class Model extends ValueObject
{
    public const NAME = 'model';

    public const LABEL = 'モデル名';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected bool $required = true; // DB Not Nullable

}
