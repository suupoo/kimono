<?php

namespace App\ValueObjects\Master\Administrator;

use App\ValueObjects\ValueObject;

class RememberToken extends ValueObject
{
    public const NAME = 'remember_token';

    public const LABEL = 'トークン';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 100;

    protected ?int $minLength = 1;

    protected bool $required = false; // DB Nullable

    public function rules(): array
    {
        return [];
    }
}
