<?php

namespace App\ValueObjects\Column\Attendance;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class StartTime extends ColumnObject
{
    public const NAME = 'start_time';

    public const LABEL = '開始時刻';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'time';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?int $min = null;

    protected ?int $max = null;

    protected string $placeholder = '00:00';

    protected bool $required = true; // DB Nullable

    public function rules(): array
    {
        return [
            'required',
            'date_format:H:i',
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        $attributes['value'] = $attributes['value'] ? date('H:i', strtotime($attributes['value'])) : '';
        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
