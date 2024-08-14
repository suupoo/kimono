<?php

namespace App\ValueObjects\Notification;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;

class Tags extends ValueObject
{
    public const NAME = 'tags';

    public const LABEL = 'タグ';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 255;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Not Nullable

    protected string $placeholder = 'タグを入力してください';

    public function rules(): array
    {
        return [
            'nullable',
            'string',
            "max:$this->maxLength",
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
