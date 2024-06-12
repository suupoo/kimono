<?php

namespace App\Models;

use App\Models\Interfaces\BaseModelInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model implements BaseModelInterface
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
        foreach ( $this->getColumns() as $column) {
            $fillables[] = $column->column();
        }

        return $fillables;
    }
}
