<?php

namespace App\ValueObjects\Notification;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class Title extends ValueObject
{
    public const NAME = 'title';

    public const LABEL = 'タイトル';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 20;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    protected string $placeholder = 'タイトル';

    public function rules(): array
    {
        return [
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
