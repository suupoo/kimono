<?php

namespace App\ValueObjects\Master\Administrator;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;

class EndAt extends ValueObject
{
    public const NAME = 'end_at';

    public const LABEL = '利用終了日';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'datetime';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    public function rules(): array
    {
        return [
            'nullable',
            'date',
            'after:'.(new StartAt)->column(),
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        if (isset($attributes['type']) && $attributes['type'] === 'date') {
            $this->type = 'date';
        }

        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
