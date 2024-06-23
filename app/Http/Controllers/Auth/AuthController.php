<?php

namespace App\Http\Controllers\Auth;

use App\Models\User as AuthModel; // モデル紐付け
use App\Http\Controllers\Controller;
use App\UseCases\AuthAction\LoginAction;
use App\UseCases\AuthAction\LogoutAction;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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

    public function loginAuth(Request $request, LoginAction $action): RedirectResponse
    {
        return $action($request, AuthModel::class);
    }

    public function logout(Request $request, LogoutAction $action): RedirectResponse
    {
        return $action($request);
    }
}
