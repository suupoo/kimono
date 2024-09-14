<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\Column\ColumnObject;

class Token extends ColumnObject
{
    public const NAME = 'token';

    public const LABEL = '認証トークン';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 255;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable
}
