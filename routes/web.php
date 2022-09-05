<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth:admin']], function () {
    // Route::get('/users', [UserController::class, 'users']);
    Route::get('/users', function () {
        return 'ok';
    });
});

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/users', function () {
        return 'ok';
    });

    Route::get('login', [LoginController::class, 'showLoginForm'])
        ->name('login_form');
    Route::post('login', [LoginController::class, 'login'])
        ->name('login');

    //Admin Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', [LoginController::class, 'destroy'])
                ->name('logout');
});

require __DIR__ . '/auth.php';
