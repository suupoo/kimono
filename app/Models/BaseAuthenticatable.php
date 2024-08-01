<?php

namespace App\Models;

use App\Models\Interfaces\BaseModelInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class BaseAuthenticatable extends Authenticatable implements BaseModelInterface
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        // fillableを設定
        $this->fillable = $this->getFillables();
    }

    private function getFillables(): array
    {
        $fillables = [];
        foreach ($this->getColumns() as $column) {
            $fillables[] = $column->column();
        }

        return $fillables;
    }
}
