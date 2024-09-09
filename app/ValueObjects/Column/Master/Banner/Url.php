<?php

namespace App\ValueObjects\Column\Master\Banner;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;

class Url extends ValueObject
{
    public const NAME = 'url';

    public const LABEL = 'URL';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 65536;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    protected string $placeholder = '開くURL';

    public function rules(): array
    {
        return [
            // 通常時のバリデーション
            'nullable',
            'string',
            "max:$this->maxLength",
            "min:$this->minLength",
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
