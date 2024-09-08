<?php

namespace App\ValueObjects\Master\Banner;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;

class Text extends ValueObject
{
    public const NAME = 'text';

    public const LABEL = '表示テキスト';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 50;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    protected string $placeholder = '表示テキスト';

    public function rules(): array
    {
        return [
            // 通常時のバリデーション
            'required',
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
