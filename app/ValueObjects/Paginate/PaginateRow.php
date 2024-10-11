<?php

namespace App\ValueObjects\Paginate;

use App\Enums\PaginateRow as PaginateRowEnum;
use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;
use Illuminate\Validation\Rule;

class PaginateRow extends ColumnObject
{
    public const NAME = 'rows';

    public const LABEL = '表示件数';

    protected string $name = self::NAME;

    protected string $columnName = '';

    protected string $label = self::LABEL;

    protected string $type = 'list';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false;

    public function rules(): array
    {
        return [
            'required',
            'integer',
            Rule::enum(PaginateRowEnum::class),
        ];
    }

    public function options(): array
    {
        return PaginateRowEnum::cases();
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label(['label-class' => 'break-keep'])
            ->select($attributes, $this->options())
            ->render();
    }
}
