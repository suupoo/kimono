<?php

use App\Http\Controllers\CustomerController;
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
        return view('welcome');
    })->name('home');
    // customers/edit/{customer}/edit などの{{  }}のパラメータをidで取得するように変更する
    Route::resource('users', UserController::class)->parameters(['users' => 'id']);
    Route::resource('customers', CustomerController::class)->parameters(['customers' => 'id']);
});
