<?php

namespace App\ValueObjects\Notification;

use App\Enums\NotificationType;
use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
use Illuminate\Validation\Rule;

class Type extends ValueObject
{
    public const NAME = 'type';

    public const LABEL = 'タイプ';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'list';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false;

    public function rules(): array
    {
        return [
            'required',
            'string',
            Rule::enum(NotificationType::class),
        ];
    }

    public function options(): array
    {
        return NotificationType::cases();
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label($attributes)
            ->select($attributes, $this->options())
            ->render();
    }
}
