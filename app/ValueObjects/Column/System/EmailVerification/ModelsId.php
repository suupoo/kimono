<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\ValueObject;

class ModelsId extends ValueObject
{
    public const NAME = 'models_id';

    public const LABEL = 'モデル内主キー';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'integer';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable
}
