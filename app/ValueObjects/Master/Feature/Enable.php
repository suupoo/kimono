<?php

namespace App\ValueObjects\Master\Feature;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;

class Enable extends ValueObject
{
    public const NAME = 'enable';

    public const LABEL = '有効フラグ';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'bool';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    /**
     * 入力フォーム要素を返す
     *
     * @return string
     */
    public function input(array $attributes = [])
    {
        return CustomForm::make($this)
            ->input($attributes)
            ->label($attributes)
            ->render();
    }
}
