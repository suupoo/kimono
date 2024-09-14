<?php

namespace App\ValueObjects\Column\Customer;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class PostCode extends ColumnObject
{
    public const NAME = 'post_code';

    public const LABEL = '郵便番号';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 8;

    protected ?int $minLength = 8;

    protected bool $required = false; // DB Nullable

    protected string $placeholder = '000-0000';

    public function rules(): array
    {
        return [
            'nullable',
            'string',
            "max:$this->maxLength",
            "min:$this->minLength",
            'regex:/^[0-9]{3}-[0-9]{4}$/',
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
