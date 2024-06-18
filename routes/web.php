<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class)->parameters(['users' => 'id']);
Route::resource('customers', CustomerController::class)->only(['create', 'store', 'index', 'edit', 'update', 'show', 'destroy'])
// customers/edit/{customer}/edit などの{{ customer }}のパラメータをidで取得するように変更する
    ->parameters(['customers' => 'id']);
