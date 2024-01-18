<?php

use App\Http\Controllers\API\PublicDataController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TuitionController;
use App\Http\Controllers\API\TutorController;
use App\Http\Controllers\Partner\AffAuthController;
use App\Http\Controllers\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Tutor\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Authentication API
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('reset_password_req', [AuthController::class, 'reset_password_req']);
Route::post('reset_password', [AuthController::class, 'reset_password']);
Route::post('update_password', [AuthController::class, 'update_password']);


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
Route::get('/salary-list', [PublicDataController::class,'salaryList'])->name('salary-list');
Route::get('/institute-type-list', [PublicDataController::class,'institype'])->name('institype');
Route::get('/study-type-list', [PublicDataController::class,'studytype'])->name('studytype');
Route::get('/university-list/{type_id}', [PublicDataController::class,'uniList'])->name('uniList');
Route::get('/dept-list/{type_id}', [PublicDataController::class,'dptList'])->name('dptList');
Route::get('/privacy-policy',[PublicDataController::class,'privacypolicy'])->name('privacypolicy');


Route::post('/multi-class-list', [PublicDataController::class,'multi_classlist'])->name('multi-class-list');
Route::post('/multi-subject-list', [PublicDataController::class,'multi_subjectlist'])->name('multi-subject-list');

Route::get('/statistics', [PublicDataController::class,'statistics'])->name('statistics');
Route::get('/divisional_tutors', [PublicDataController::class,'divisional_tutors'])->name('divisional_tutors');

Route::get('/tuition-list/{limit}', [TuitionController::class,'tuition_list'])->name('tuition-list');
Route::get('/job-board/{limit}', [TuitionController::class,'job_board'])->name('job-board');
Route::get('/tuition_details/{id}', [TuitionController::class,'tuitionView'])->name('tuition-view');


// Route::get('/popular_tutor_list/{limit}', [PublicDataController::class,'popular_tutor_list'])->name('popular_tutor_list');
Route::get('/random_popular_tutor', [PublicDataController::class,'random_popular_tutor'])->name('random_popular_tutor-view');
Route::get('/tutor_list', [PublicDataController::class,'tutor_list'])->name('tutor_list');
Route::get('/tutor_details/{id}', [PublicDataController::class,'tutor_details'])->name('tutor_details');


Route::post('/tutor_request', [PublicDataController::class,'tutor_request'])->name('tutor_request');
Route::post('/ref_tutor_request', [PublicDataController::class,'ref_tutor_request'])->name('ref_tutor_request');
Route::post('/student_to_teacher_request', [TutorController::class,'teacherRequest'])->name('student_to_teacher_request');



// Middleware
Route::middleware(['auth:sanctum', 'isTutor'])->group(function () {
    Route::get('/checkingTutor', function () {
        return response()->json(['message' => 'You are logged in as Tutor', 'status' => 200], 200);
    });

});

Route::group(['middleware' => ['isTutor'],'prefix' => '/tutor', 'namespace' => 'Tutor', 'as' => 'tutor.'], function () {
    Route::get('user_info', [TutorController::class,'info'])->name('user_info');
    Route::get('dashboard_info', [TutorController::class,'dashboard'])->name('user_dashboard');
    Route::post('update_personal_info', [TutorController::class,'update_personal_info'])->name('update_personal_info');
    Route::post('update_profile_photo', [TutorController::class,'update_profile_photo'])->name('update_profile_photo');
    Route::post('update_educational_info', [TutorController::class,'update_educational_info'])->name('update_educational_info');
    Route::post('update_tuition_info', [TutorController::class,'update_tuition_info'])->name('update_tuition_info');
    Route::post('update_documents', [TutorController::class,'update_documents'])->name('update_documents');


    Route::post('tuition_apply', [TutorController::class,'tuition_apply'])->name('tuition_apply');

    Route::get('tuition_matching_payments_list', [TutorController::class,'tuition_matching_payments_list'])->name('tuition_matching_payments_list');
    Route::get('tuition_matching_transactions/{id}', [TutorController::class,'tuition_matching_transactions'])->name('tuition_matching_transactions');

    Route::get('profile_verification_req_submit', [TutorController::class,'profile_verification_req_submit'])->name('profile_verification_req_submit');
    Route::get('profile_premium_req_submit', [TutorController::class,'profile_premium_req_submit'])->name('profile_premium_req_submit');

    Route::get('notifications', [TutorController::class,'notifications'])->name('notifications');

    Route::get('apply_tuition_list/{limit}', [TutorController::class,'applyTuitionList'])->name('apply_tuition_list');
    Route::get('assigned_tuition_list/{limit}', [TutorController::class,'assignedTuitionList'])->name('asssigned_tuition_list');
    Route::get('confirmed_tuition_list/{limit}', [TutorController::class,'confirmedTuitionList'])->name('confirmed_tuition_list');
    Route::get('cancelled_tuition_list/{limit}', [TutorController::class,'cancelledTuitionList'])->name('cancelled_tuition_list');

});



Route::middleware(['auth:sanctum','isTutor'])->get('/user', function (Request $request) {
    return response()->json([
        'status' => 200,
        'user' => $request->user(),
    ]);
});



//--------------------Student/Guardian Routes-----------------------//

Route::post('stu_register', [StudentAuthController::class, 'register']);
Route::post('stu_login', [StudentAuthController::class, 'login']);

Route::group(['middleware' => ['isStudent'],'prefix' => '/student', 'namespace' => 'Student', 'as' => 'student.'], function () {
    Route::get('user_info', [StudentController::class,'info'])->name('user_info');
    Route::post('tutor-request', [StudentController::class,'tutorRequest'])->name('tutorRequest');
    Route::get('posted-jobs', [StudentController::class,'postedJobs'])->name('postedJobs');
});







//--------------------Affiliate Partner (Uddokta) Routes-----------------------//

Route::post('aff_register', [AffAuthController::class, 'register']);
Route::post('aff_login', [AffAuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum','isPartner'],'prefix' => '/partner', 'namespace' => 'Partner', 'as' => 'partner.'], function () {
    Route::get('user_info', [AffAuthController::class, 'info']);
    Route::post('logout', [AffAuthController::class, 'logout']);

    Route::post('user_info_update', [AffAuthController::class, 'user_info_update']);
    Route::post('user_acc_update', [AffAuthController::class, 'user_acc_update']);
    Route::post('lead_generate', [AffAuthController::class, 'lead_generate']);
    Route::get('lead_list/{limit}', [AffAuthController::class, 'lead_list']);

    Route::post('update_profile_photo', [AffAuthController::class,'update_profile_photo']);
});
