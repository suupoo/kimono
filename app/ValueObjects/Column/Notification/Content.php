<?php

namespace App\ValueObjects\Column\Notification;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class Content extends ColumnObject
{
    public const NAME = 'content';

    public const LABEL = '内容';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'text';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Not Nullable

    protected ?string $placeholder = null;

    public function rules(): array
    {
        return [
            'required',
            'string',
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label($attributes)
            ->editor($attributes)
            ->render();
    }
}
