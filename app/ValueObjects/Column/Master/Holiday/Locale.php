<?php

namespace App\ValueObjects\Column\Master\Holiday;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;
use Illuminate\Validation\Rule;
use App\Enums\Locale as LocaleEnum;

class Locale extends ColumnObject
{
    public const NAME = 'locale';

    public const LABEL = '国';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 10;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected string $placeholder = self::LABEL;

    public function rules(): array
    {
        return [
            'required',
            'string',
            Rule::enum(LocaleEnum::class),
        ];
    }

    public function options(): array
    {
        return LocaleEnum::cases();
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
