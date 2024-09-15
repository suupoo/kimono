<?php

namespace App\ValueObjects\Module\TableDefinition;

use stdClass;

class Column
{
    protected ?string $name;
    protected ?string $type;
    protected ?string $nullable;
    protected ?string $key;
    protected ?string $default;
    protected ?string $extra;
    protected ?string $privileges;
    protected ?string $comment;

    public function __construct(stdClass $data)
    {
        $this->name = $data?->Field ?? null;
        $this->type = $data?->Type ?? null;
        $this->nullable = $data?->Null ?? null;
        $this->key = $data?->Key ?? null;
        $this->default = $data?->Default ?? null;
        $this->extra = $data?->Extra ?? null;
        $this->privileges = $data?->Privileges ?? null;
        $this->comment = $data?->Comment ?? null;
    }

    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }
        return null;
    }
}
