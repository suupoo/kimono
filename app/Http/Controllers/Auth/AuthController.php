<?php

namespace App\Http\Controllers\Auth;

use App\Models\User as AuthModel; // モデル紐付け
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected AuthModel $model;

    public function __construct()
    {
        $this->model = new AuthModel;
    }

    public function login()
    {
        $model = new $this->model;
        return view('auth.login', compact('model'));
    }

    public function auth()
    {

    }
}
