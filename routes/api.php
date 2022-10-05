<?php

use App\Http\Controllers\API\PublicDataController;
use App\Http\Controllers\API\TuitionController;
use App\Http\Controllers\Tutor\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Authentication API
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Auth Routes...
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

//Public Routes
Route::get('bannar-list', [PublicDataController::class, 'banner']);

Route::get('/area-list/{district_id}', [PublicDataController::class,'arealist'])->name('area-list');
Route::get('/class-list/{medium_id}', [PublicDataController::class,'classlist'])->name('class-list');
Route::get('/subject-list/{class_id}', [PublicDataController::class,'subjectlist'])->name('subject-list');

Route::get('/district-list', [PublicDataController::class,'allDistrict'])->name('district-list');
Route::get('/medium-list', [PublicDataController::class,'allMedium'])->name('medium-list');

Route::get('/tuition-list/{limit}', [TuitionController::class,'tuition_list'])->name('tuition-list');
Route::get('/tuition-list/view/{id}', [TuitionController::class,'tuitionView'])->name('tuition-view');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();

    return response()->json([
        'status' => 200,
        'user' => $request->user(),
    ]);
});
