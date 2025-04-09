<?php

namespace App\ValueObjects\Column;

class NoColumnObject extends ColumnObject
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

    public function __construct($attributes = [])
    {
        if (array_key_exists('name', $attributes)) {
            $this->name = $attributes['name'];
        }
        if (array_key_exists('columnName', $attributes)) {
            $this->columnName = null;
        }
        if (array_key_exists('label', $attributes)) {
            $this->label = $attributes['label'];
        }
        if (array_key_exists('type', $attributes)) {
            $this->type = $attributes['type'];
        }
    }
}
