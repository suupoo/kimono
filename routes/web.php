<?php

use App\Http\Controllers\ResourceControllers\UserController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('customers', CustomerController::class);
