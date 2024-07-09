<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'loginAuth'])->name('login.auth');
    Route::get('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth'], function () {
    // ログイン時
    Route::get('/', function () {
        return view('home.index');
    })->name('home');
    // customers/edit/{customer}/edit などの{{  }}のパラメータをidで取得するように変更する
    Route::resource('users', UserController::class)->parameters(['users' => 'id']);
    Route::resource('administrators', AdministratorController::class)->parameters(['administrators' => 'id']);
    Route::resource('customers', CustomerController::class)->parameters(['customers' => 'id']);
    Route::resource('stores', StoreController::class)->parameters(['stores' => 'id']);
    Route::resource('staffs', StaffController::class)->parameters(['staffs' => 'id']);
    // マイページ
    Route::get('mypage', [MyPageController::class, 'index'])->name('mypage.index');
});

Route::get('/build/{any}', function ($any) {
    $extensions = substr($any, strrpos($any, '.') + 1);
    $mine_type = [
        'css' => 'text/css',
        'js' => 'application/javascript',
    ];
    if (! array_key_exists($extensions, $mine_type)) {
        return \App::abort(404);
    }
    if (! file_exists(public_path().'/build/'.$any)) {
        return \App::abort(404);
    }

    return response(\File::get(public_path().'/build/'.$any))->header('Content-Type', $mine_type[$extensions]);
})->where('any', '.*');
