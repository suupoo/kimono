<?php

namespace App\ValueObjects\Column;

use App\ValueObjects\ValueObject;

class ColumnObject extends ValueObject
{
    protected string $name;

    protected string $columnName;

    protected string $label;

    protected string $type;

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?int $min = null;

    protected ?int $max = null;

    protected bool $required = false;

    protected bool $primaryKey = false;

    protected bool $unique = false;

    public function id(): ?string
    {
        return $this->name;
    }

    /**
     * カラム名を返す
     */
    public function column(): ?string
    {
        return $this->columnName;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    /**
     * 表示名を返す
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

    public function placeholder(): ?string
    {
        return (property_exists($this, 'placeholder'))
            ? $this->placeholder
            : null;
    }

    /**
     * 入力タイプを返す
     */
    public function inputType(): ?string
    {
        return match ($this->type) {
            'string' => 'text',
            'integer' => 'number',
            'bool' => 'checkbox',
            'password' => 'password',
            'datetime' => 'datetime-local',
            'email' => 'email',
            'image' => 'file',
            'date' => 'date',
            'list' => 'select',
            default => null,
        };
    }

    /**
     * 入力フォーム要素を返す
     *
     * @return string
     */
    public function input(array $attributes = [])
    {
        return null;
    }
}
