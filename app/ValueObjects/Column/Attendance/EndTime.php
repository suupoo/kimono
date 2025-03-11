<?php

namespace App\ValueObjects\Column\Attendance;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class EndTime extends ColumnObject
{
    public const NAME = 'end_time';

    public const LABEL = '終了時刻';

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
            function ($attribute, $value, $fail) {
                $startDate = request()->input('start_date');
                $startTime = request()->input('start_time');
                $start = strtotime($startDate . ' ' . $startTime);
                if ($start && $start >= $value) {
                    $fail($this->label().'には開始時刻より後の時刻を入力してください。');
                }
            },
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
