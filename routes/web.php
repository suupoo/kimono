<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;
use Laravel\Pennant\Middleware\EnsureFeaturesAreActive;

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
    Route::resource('users', UserController::class)->parameters(['users' => 'id'])->middleware(EnsureFeaturesAreActive::using('users'));
    Route::resource('administrators', AdministratorController::class)->parameters(['administrators' => 'id'])->middleware(EnsureFeaturesAreActive::using('administrators'));
    Route::resource('customers', CustomerController::class)->parameters(['customers' => 'id'])->middleware(EnsureFeaturesAreActive::using('customers'));
    Route::resource('stores', StoreController::class)->parameters(['stores' => 'id'])->middleware(EnsureFeaturesAreActive::using('stores'));
    Route::resource('staffs', StaffController::class)->parameters(['staffs' => 'id'])->middleware(EnsureFeaturesAreActive::using('staffs'));
    // マイページ
    Route::get('mypage', [MyPageController::class, 'index'])->name('mypage.index');

    // システム管理用機能 todo:管理者以外は不可にする
    Route::group(['controller' => SystemController::class, 'prefix' => 'system' ], function () {
        Route::get('/features', 'listFeature')->name('system.listFeature');
        Route::post('/features', 'saveFeature')->name('system.saveFeature');
    });
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
