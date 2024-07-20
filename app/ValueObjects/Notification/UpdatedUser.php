<?php

namespace App\ValueObjects\Notification;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class UpdatedUser extends ValueObject
{
    public const NAME = 'updated_user';

    public const LABEL = '更新者';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'number';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    public function rules(): array
    {
        return [
            'integer',
            'exists:users,id',
        ];
    }
}
