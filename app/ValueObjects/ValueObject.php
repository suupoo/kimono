<?php

namespace App\ValueObjects;

abstract class ValueObject
{
    protected ?string $value;
    protected string $name;
    protected string $columnName;
    protected string $label;
    protected string $type;
    protected ?int $maxLength = null;
    protected ?int $minLength = null;
    protected bool $required = false;

    public function id(): ?string
    {
        return $this->name;
    }

    /**
     * カラム名を返す
     * @return string|null
     */
    public function column(): ?string
    {
        return $this->columnName;
    }

    /**
     * 表示名を返す
     * @return string
     */
    public function label(): string
    {
        return $this->label ?? '';
    }

    public function maxLength(): ?int
    {
        return $this?->maxLength;
    }

    public function minLength(): ?int
    {
        return $this?->minLength;
    }

    public function required(): bool
    {
        return $this->required;
    }

    /**
     * 入力タイプを返す
     * @return string|null
     */
    public function inputType(): ?string
    {
        return match ($this->type) {
            'string'    => 'text',
            'integer'   => 'number',
            'date'      => 'date',
            'list'      => 'select',
            default     => null,
        };
    }
}
