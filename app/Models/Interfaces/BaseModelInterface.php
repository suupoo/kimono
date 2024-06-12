<?php

namespace App\Models\Interfaces;

interface BaseModelInterface
{
    /**
     * カラムを定義する関数
     * @return array
     */
    public static function getColumns(): array;
}
