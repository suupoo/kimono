<?php

namespace App\ValueObjects\Column\Master\CompanyDashboard;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class Dashboard extends ColumnObject
{
    public const NAME = 'dashboard';

    public const LABEL = 'ダッシュボード';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'text';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Not Nullable

    protected ?string $placeholder = null;

    public function rules(): array
    {
        return [
            'nullable',
            'string',
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->editor($attributes)
            ->render();
    }
}
