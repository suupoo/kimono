<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group([], function () {
    Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
    Route::post('auth', [\App\Http\Controllers\Auth\AuthController::class, 'auth'])->name('auth');
});
Route::resource('users', UserController::class)->parameters(['users' => 'id']);
Route::resource('customers', CustomerController::class)->only(['create', 'store', 'index', 'edit', 'update', 'show', 'destroy'])
// customers/edit/{customer}/edit などの{{ customer }}のパラメータをidで取得するように変更する
    ->parameters(['customers' => 'id']);
