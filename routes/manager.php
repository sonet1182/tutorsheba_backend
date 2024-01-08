<?php

use App\Http\Controllers\Manager\AllRequestController;
use App\Http\Controllers\Manager\AuthController;
use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\MessageController;
use App\Http\Controllers\Manager\SearchController;
use App\Http\Controllers\Manager\StudentController;
use App\Http\Controllers\Manager\StudentRequestController;
use App\Http\Controllers\Manager\TeacherRequestController;
use App\Http\Controllers\Manager\TextMessageController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/manager', 'as' => 'manager.'], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login_form');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
});


Route::group(['middleware' => ['isManager'], 'prefix' => '/manager', 'as' => 'manager.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('reset_password', [AuthController::class, 'reset_pass_view'])->name('reset_password');
    Route::post('reset_password', [AuthController::class, 'resetPassword']);

    Route::post('/search/name', [SearchController::class, 'searchName'])->name('search.name');
    Route::post('/search/id', [SearchController::class, 'searchId'])->name('search.id');
    Route::post('/search/institution', [SearchController::class, 'searchInstitution'])->name('search.institution');
    Route::post('/search/phone-number', [SearchController::class, 'searchPhoneNumber'])->name('search.phoneNumber');
    Route::post('/search/email-address', [SearchController::class, 'searchEmailAddress'])->name('search.email');
    Route::any('/search/results', [SearchController::class, 'searchResult2'])->name('searchResult');
    Route::any('/search-by-edu-info/results', [SearchController::class, 'searchResultByEdu'])->name('searchResultByEdu');

    Route::get('new_teacher_request', [TeacherRequestController::class, 'newTeacherRequest']);
    Route::get('new_teacher_request_approve_all', [TeacherRequestController::class, 'newTeacherRequest_approve_all']);
    Route::get('approval_teacher_list', [TeacherRequestController::class, 'approvalTeacherList']);
    Route::get('verified_teacher_list', [TeacherRequestController::class, 'verifiedTeacherList']);
    Route::get('home_approval_teacher', [TeacherRequestController::class, 'homeApprovalTeacherList']);
    Route::get('rejected_teacher_list', [TeacherRequestController::class, 'rejectedTeacherList']);
    Route::get('teacher_details{id}', [TeacherRequestController::class, 'teacherDetails']);
    Route::get('teacher_approval{id}', [TeacherRequestController::class, 'teacherApproval']);
    Route::get('teacher_verify{id}', [TeacherRequestController::class, 'teacherVerify']);
    Route::any('teacher_premium{id}', [TeacherRequestController::class, 'teacherPremium']);
    Route::get('teacher_rejected{id}', [TeacherRequestController::class, 'teacherRejected']);

    Route::post('approval_student_list/note/{id}', [StudentRequestController::class, 'add_note']);

    Route::get('/apply_tuition_list/{id}', [StudentRequestController::class, 'applyTuitionList'])->name('user.apply_tuition_list');
    Route::get('/assigned_tuition_list/{id}', [StudentRequestController::class, 'assignedTuitionList'])->name('user.asssigned_tuition_list');
    Route::get('/confirmed_tuition_list/{id}', [StudentRequestController::class, 'confirmedTuitionList'])->name('user.confirmed_tuition_list');
    Route::get('/cancelled_tuition_list/{id}', [StudentRequestController::class, 'cancelledTuitionList'])->name('user.cancelled_tuition_list');

    Route::get('new_student_request', [StudentRequestController::class, 'newStudentRequest']);
    Route::get('approval_student_list', [StudentRequestController::class, 'approvalStudentList']);
    Route::get('approval_student_list/by_manager/{id}', [StudentRequestController::class, 'tuition_search_by_manager']);
    Route::get('rejected_student_list', [StudentRequestController::class, 'rejectedStudentList']);
    Route::get('pending_student_list', [StudentRequestController::class, 'pendingStudentList']);
    Route::get('cancelled_student_list', [StudentRequestController::class, 'cancelStudentList']);
    Route::get('set_student_pending/{id}', [StudentRequestController::class, 'setPending']);
    Route::get('set_student_cancel/{id}', [StudentRequestController::class, 'setCancel']);
    Route::get('student_details{id}', [StudentRequestController::class, 'StudentDetails']);
    Route::post('/find_teacher', [StudentRequestController::class, 'find_teacher'])->name('find_teacher');
    Route::post('/assign_teacher', [StudentRequestController::class, 'assign_teacher'])->name('assign_teacher');
    Route::post('/confirm_teacher', [StudentRequestController::class, 'confirm_teacher'])->name('confirm_teacher');
    Route::post('/reject_teacher', [StudentRequestController::class, 'reject_teacher'])->name('reject_teacher');
    Route::post('/assigned_teacher/edit/{id}', [StudentRequestController::class, 'assign_teacher_edit'])->name('assign_teacher_edit');
    Route::post('/confirmed_teacher/edit/{id}', [StudentRequestController::class, 'confirmed_teacher_edit'])->name('confirmed_teacher_edit');

    Route::get('/student/create', [StudentController::class, 'create']);
    Route::post('/student/store', [StudentController::class, 'store']);
    Route::get('/tuition/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/tuition/update', [StudentController::class, 'update']);

    Route::get('student_tutor_request', [AllRequestController::class, 'studentTutorRequest'])->name('studentTutorRequest');
    Route::get('teacher_tuition_request', [AllRequestController::class, 'teacherTuitionRequest'])->name('SteacherTuitionRequest');
    Route::get('request-details/{id}', [AllRequestController::class, 'requestDetails'])->name('requestDetails');

    Route::any('/send_text', [TextMessageController::class, 'send_text'])->name('admin.send_text');
    Route::post('/send_bulk_text', [TextMessageController::class, 'send_bulk_text'])->name('admin.send_bulk_text');

    Route::any('tuition_search_by_id', [StudentRequestController::class, 'tuition_search_by_id']);
    Route::any('tuition_search_by_phone', [StudentRequestController::class, 'tuition_search_by_phone']);

    Route::get('payment_sheet', [StudentRequestController::class, 'payment_sheet']);
    Route::post('payment/tuition_search_by_id', [StudentRequestController::class, 'payment_tuition_search_by_id']);
    Route::post('payment/tuition_search_by_phone', [StudentRequestController::class, 'payment_tuition_search_by_phone']);
    Route::any('payment/approval_student_list/by_manager/{id}', [StudentRequestController::class, 'payment_tuition_search_by_manager']);

    Route::get('payment_details/{id}', [StudentRequestController::class, 'payment_details']);
    Route::post('payment_submit/{id}', [StudentRequestController::class, 'payment_submit']);
    Route::get('transactions', [StudentRequestController::class, 'transactions']);
    Route::post('transactions/edit/{id}', [StudentRequestController::class, 'update_transactions']);
    Route::any('transactions/search', [StudentRequestController::class, 'transactions_search']);

    Route::get('/receiver_list/{id}', [StudentRequestController::class, 'receiver_list'])->name('receiver_list');
    Route::get('/applied_receiver_list/{id}', [StudentRequestController::class, 'applied_receiver_list'])->name('applied_receiver_list');

    Route::any('/send_text', [MessageController::class, 'send_text'])->name('admin.send_text');
    Route::post('/send_bulk_text', [MessageController::class, 'send_bulk_text'])->name('admin.send_bulk_text');
});
