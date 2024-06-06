<?php

namespace App\Http\Controllers;

abstract class ResourceController extends Controller
{
    protected string $model;

    public function create()
    {
        return response(200);
    }
}
