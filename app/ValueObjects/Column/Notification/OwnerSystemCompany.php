<?php

namespace App\ValueObjects\Column\Notification;

use App\ValueObjects\ValueObject;

class OwnerSystemCompany extends ValueObject
{
    public const NAME = 'owner_system_company';

    public const LABEL = 'OWNER_SYSTEM_COMPANY';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'integer';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    protected bool $primaryKey = false;

    public function rules(): array
    {
        return [
            'integer',
            'exists:m_system_companies,id',
        ];
    }
}
