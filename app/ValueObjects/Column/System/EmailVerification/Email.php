<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\Column\ColumnObject;

class Email extends ColumnObject
{
    public const NAME = 'email';

    public const LABEL = 'メールアドレス';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'email';

    protected ?int $maxLength = 50;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

}
