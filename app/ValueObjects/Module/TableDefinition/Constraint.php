<?php

namespace App\ValueObjects\Module\TableDefinition;

use stdClass;

class Constraint
{
    protected ?string $type;
    protected ?string $constraintCatalog;
    protected ?string $constraintSchema;
    protected ?string $constraintName;
    protected ?string $tableCatalog;
    protected ?string $tableSchema;
    protected ?string $tableName;
    protected ?string $columnName;
    protected ?string $ordinalPosition;
    protected ?string $positionInUniqueConstraint;
    protected ?string $referencedTableSchema;
    protected ?string $referencedTableName;
    protected ?string $referencedColumnName;

    public function __construct(stdClass $data)
    {
        $this->constraintCatalog = $data?->CONSTRAINT_CATALOG ?? null;
        $this->constraintSchema = $data?->CONSTRAINT_SCHEMA ?? null;
        $this->constraintName = $data?->CONSTRAINT_NAME ?? null;
        $this->tableCatalog = $data?->TABLE_CATALOG ?? null;
        $this->tableSchema = $data?->TABLE_SCHEMA ?? null;
        $this->tableName = $data?->TABLE_NAME ?? null;
        $this->columnName = $data?->COLUMN_NAME ?? null;
        $this->ordinalPosition = $data?->ORDINAL_POSITION ?? null;
        $this->positionInUniqueConstraint = $data?->POSITION_IN_UNIQUE_CONSTRAINT ?? null;
        $this->referencedTableSchema = $data?->REFERENCED_TABLE_SCHEMA ?? null;
        $this->referencedTableName = $data?->REFERENCED_TABLE_NAME ?? null;
        $this->referencedColumnName = $data?->REFERENCED_COLUMN_NAME ?? null;
    }

    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }
        return null;
    }
}
