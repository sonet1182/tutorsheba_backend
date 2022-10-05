<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchResultController;
use App\Http\Controllers\Frontend\TeacherController;
use App\Http\Controllers\Frontend\TuitionController;
use App\Http\Controllers\SearchManageController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
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


// Feches Routes //
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/tuition-list', [TuitionController::class,'tuition'])->name('tuition-list');
Route::get('/tuition-list/view/{id}', [TuitionController::class,'tuitionView'])->name('tuition-view');

Route::get('/area-list', [SearchManageController::class,'arealist'])->name('area-list');
Route::get('/class-list', [SearchManageController::class,'classlist'])->name('class-list');
Route::get('/subject-list', [SearchManageController::class,'subjectlist'])->name('subject-list');

Route::get('/featured-tutors', [HomeController::class,'featured'])->name('featured');

Route::any('/search-tutor', [SearchResultController::class,'searchResult'])->name('searchResult');

Route::get('/tutor-details/{id}', [TeacherController::class,'details'])->name('tutor_details');

Route::get('/request-for-tutor', [TeacherController::class,'request'])->name('tutor_request');
Route::post('/tuition_request', [TeacherController::class,'store'])->name('request.store');



////////////////////////////////////


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/users', function () {
        return 'ok';
    });
});

/////////////***** Tutor *******////////////////
Route::group(['middleware' => ['isTutor'],'prefix' => '/tutor', 'namespace' => 'Tutor', 'as' => 'tutor.'], function () {

    Route::get('dashboard', [TutorDashboardController::class,'dashboard'])->name('dashboard');
});





///////////////////////////////

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/users', function () {
        return 'ok22';
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
