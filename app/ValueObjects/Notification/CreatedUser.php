<?php

namespace App\ValueObjects\Notification;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class CreatedUser extends ValueObject
{
    public const NAME = 'created_user';

    public const LABEL = '作成者';

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
