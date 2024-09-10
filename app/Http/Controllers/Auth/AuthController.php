<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // モデル紐付け
use App\Models\MSystemAdministrator as AuthModel;
use App\UseCases\AuthAction\LoginAction;
use App\UseCases\AuthAction\LogoutAction;
use App\UseCases\AuthAction\VerifyEmailAction;use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    /**
     * メールアドレス確認
     * @param Request $request
     * @param VerifyEmailAction $action
     * @return View
     */
    public function verifyEmail(Request $request, VerifyEmailAction $action):View
    {
       $action($request, AuthModel::class);

        return view('auth.verify-email');
    }
}
