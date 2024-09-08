<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SystemAdministratorController;
use App\Http\Controllers\SystemBannerController;
use App\Http\Controllers\SystemCompanyController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\HasPrivilegeOfLogin;
use Illuminate\Support\Facades\Route;
use Laravel\Pennant\Middleware\EnsureFeaturesAreActive;

Route::group([], function () {
    Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'loginAuth'])->name('login.auth');
    Route::get('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
    Route::get('/terms', function () {
        return view('about.terms');
    })->name('terms');

    Route::get('/privacy', function () {
        return view('about.privacy');
    })->name('privacy');
});

Route::group(['middleware' => ['auth', HasPrivilegeOfLogin::class]], function () {
    // ログイン時
    Route::get('/', function () {
        return view('home.index');
    })->name('home');
    Route::middleware([\App\Http\Middleware\HasPrivilegeOfResource::class])->group(function (){
        Route::group([], function () {
            // CSVエクスポート
            Route::get('companies/export/csv', [CompanyController::class, 'exportCsv'])->name('companies.export.csv');
            Route::get('customers/export/csv', [CustomerController::class, 'exportCsv'])->name('customers.export.csv');
            Route::get('staffs/export/csv', [StaffController::class, 'exportCsv'])->name('staffs.export.csv');
            Route::get('stores/export/csv', [StoreController::class, 'exportCsv'])->name('stores.export.csv');
            Route::get('stocks/export/csv', [StockController::class, 'exportCsv'])->name('stocks.export.csv');
            Route::get('users/export/csv', [UserController::class, 'exportCsv'])->name('users.export.csv');
            // PDFエクスポート
            Route::get('customers/export/pdf', [CustomerController::class, 'exportPdf'])->name('customers.export.pdf');
        });
        // customers/edit/{customer}/edit などの{{  }}のパラメータをidで取得するように変更する
        Route::resource('users', UserController::class)->parameters(['users' => 'id'])->middleware(EnsureFeaturesAreActive::using('users'));
        Route::resource('customers', CustomerController::class)->parameters(['customers' => 'id'])->middleware(EnsureFeaturesAreActive::using('customers'));
        Route::resource('companies', CompanyController::class)->parameters(['companies' => 'id'])->middleware(EnsureFeaturesAreActive::using('companies'));
        Route::middleware(EnsureFeaturesAreActive::using('stores'))->group(function () {
            Route::resource('stores', StoreController::class)->parameters(['stores' => 'id']);
            Route::get('stores/{id}/staffs', [StoreController::class, 'staffs'])->name('stores.staffs.list');
            Route::post('stores/{id}/staffs', [StoreController::class, 'saveStaffs'])->name('stores.staffs.save');
        });
        Route::resource('staffs', StaffController::class)->parameters(['staffs' => 'id'])->middleware(EnsureFeaturesAreActive::using('staffs'));
        Route::resource('stocks', StockController::class)->parameters(['stocks' => 'id'])->middleware(EnsureFeaturesAreActive::using('stocks'));
        Route::resource('notifications', NotificationController::class)->parameters(['notifications' => 'id'])->middleware(EnsureFeaturesAreActive::using('notifications'));
    });
    // マイページ
    Route::get('mypage', [MyPageController::class, 'index'])->name('mypage.index');
    // 個人設定
    Route::get('me', [MeController::class, 'list'])->name('me.list');
    Route::post('me', [MeController::class, 'save'])->name('me.save');

    // システム管理用機能 todo:管理者以外は不可にする
    Route::group(['prefix' => 'system', 'as' => 'system.'], function () {
        Route::group(['controller' => SystemController::class], function () {
            Route::get('/features', 'listFeature')->name('listFeature');
            Route::post('/features', 'saveFeature')->name('saveFeature');
        });
        Route::resource('banners', SystemBannerController::class)->parameters(['banners' => 'id']);
        Route::resource('companies', SystemCompanyController::class)->parameters(['companies' => 'id']);
        Route::resource('administrators', SystemAdministratorController::class)->parameters(['administrators' => 'id']);
        Route::get('administrators/{id}/companies', [SystemAdministratorController::class, 'companies'])->name('administrators.companies.list');
        Route::post('administrators/{id}/companies', [SystemAdministratorController::class, 'saveCompanies'])->name('administrators.companies.save');
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


// jsファイルを読み込むためのルーティング
Route::get('js/script.js', function () {
    return response(\File::get(public_path().'/js/script.js'))->header('Content-Type','application/javascript');
});
// cssファイルを読み込むためのルーティング
Route::get('css/style.css', function () {
    return response(\File::get(public_path().'/css/style.css'))->header('Content-Type','text/css');
});
