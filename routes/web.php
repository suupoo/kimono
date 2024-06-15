<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ResourceControllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('customers', CustomerController::class)->only(['create', 'store', 'index', 'edit', 'destroy'])
// customers/edit/{customer}/edit などの{{ customer }}のパラメータをidで取得するように変更する
    ->parameters(['customers' => 'id']);
