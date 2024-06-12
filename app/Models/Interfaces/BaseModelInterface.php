<?php

namespace App\Models\Interfaces;

interface BaseModelInterface
{
    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array;
}
