<?php

namespace App\Http\Controllers\ResourceControllers;

use App\Http\Controllers\ResourceController;
use App\Models\User;

class UserController extends ResourceController
{
    protected string $model = User::class;
}
