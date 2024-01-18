<?php

use App\Http\Controllers\Admin\AdminSearchController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdsImagesController;
use App\Http\Controllers\Admin\AllRequestController;
use App\Http\Controllers\Admin\ApprovalStudentController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\Management\PrivacyPolicyController;
use App\Http\Controllers\Admin\Member\BalanceController;
use App\Http\Controllers\Admin\Member\MembershipController;
use App\Http\Controllers\Admin\ReplyContactController;
use App\Http\Controllers\Admin\searchManage\AllAreaController;
use App\Http\Controllers\Admin\searchManage\AllClassController;
use App\Http\Controllers\Admin\searchManage\AllDistrictController;
use App\Http\Controllers\Admin\searchManage\AllMediumController;
use App\Http\Controllers\Admin\searchManage\AnySubjectController;
use App\Http\Controllers\Admin\searchManage\DepartmentController;
use App\Http\Controllers\Admin\searchManage\InstTypeController;
use App\Http\Controllers\Admin\searchManage\SalaryRangeController;

use App\Http\Controllers\Admin\searchManage\StudyTypeController;
use App\Http\Controllers\Admin\searchManage\UniversityController;
use App\Http\Controllers\Admin\SearchResultController as AdminSearchResultController;
use App\Http\Controllers\Admin\SliderImagesController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentRequestController;
use App\Http\Controllers\Admin\UddoktaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchResultController;
use App\Http\Controllers\Frontend\TeacherController;
use App\Http\Controllers\Frontend\TuitionController;
use App\Http\Controllers\HowItWorksController;
use App\Http\Controllers\SearchManageController;
use App\Http\Controllers\TeacherRequestController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;




// Feches Routes //
Route::get('/', [AdminController::class, 'index'])->name('home');

Route::get('/tuition-list', [TuitionController::class, 'tuition'])->name('tuition-list');
Route::get('/tuition-list/view/{id}', [TuitionController::class, 'tuitionView'])->name('tuition-view');

Route::get('/area-list', [SearchManageController::class, 'arealist'])->name('area-list');
Route::get('/class-list', [SearchManageController::class, 'classlist'])->name('class-list');
Route::get('/subject-list', [SearchManageController::class, 'subjectlist'])->name('subject-list');
Route::get('/institute-list', [SearchManageController::class, 'institutelist'])->name('institute-list');
Route::get('/department-list', [SearchManageController::class, 'departmentlist'])->name('department-list');

Route::get('/featured-tutors', [HomeController::class, 'featured'])->name('featured');

Route::any('/search-tutor', [SearchResultController::class, 'searchResult'])->name('searchResult');

Route::get('/tutor-details/{id}', [TeacherController::class, 'details'])->name('tutor_details');

Route::get('/request-for-tutor', [TeacherController::class, 'request'])->name('tutor_request');
Route::post('/tuition_request', [TeacherController::class, 'store'])->name('request.store');


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
Route::group(['middleware' => ['isTutor'], 'prefix' => '/tutor', 'namespace' => 'Tutor', 'as' => 'tutor.'], function () {
    Route::get('dashboard', [TutorDashboardController::class, 'dashboard'])->name('dashboard');
});



/** Admin Route List **/
Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login_form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::group(['middleware' => ['isAdmin'], 'prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    //Admin Dashboard
    Route::get('/', [AdminController::class, 'index']);
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('all_text', 'Admin\HomeController@individual_notice')->name('all_text');


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


    Route::get('new_student_request', [StudentRequestController::class, 'newStudentRequest']);
    Route::get('approval_student_list', [StudentRequestController::class, 'approvalStudentList']);
    Route::get('approval_student_list/by_manager/{id}', [StudentRequestController::class, 'tuition_search_by_manager']);
    Route::get('rejected_student_list', [StudentRequestController::class, 'rejectedStudentList']);

    Route::get('pending_student_list', [StudentRequestController::class, 'pendingStudentList']);
    Route::get('cancelled_student_list', [StudentRequestController::class, 'cancelStudentList']);
    Route::get('set_student_pending/{id}', [StudentRequestController::class, 'setPending']);
    Route::get('set_student_cancel/{id}', [StudentRequestController::class, 'setCancel']);

    Route::get('student_approval{id}', [ApprovalStudentController::class, 'StudentApproval']);
    Route::get('student_rejected{id}', [ApprovalStudentController::class, 'StudentRejected']);


    Route::get('student_details{id}', [StudentRequestController::class, 'StudentDetails']);

    Route::any('tuition_search_by_id', [StudentRequestController::class, 'tuition_search_by_id']);
    Route::any('tuition_search_by_phone', [StudentRequestController::class, 'tuition_search_by_phone']);

    Route::get('payment_sheet', [StudentRequestController::class, 'payment_sheet']);
    Route::post('payment/tuition_search_by_id', [StudentRequestController::class, 'payment_tuition_search_by_id']);
    Route::post('payment/tuition_search_by_phone', [StudentRequestController::class, 'payment_tuition_search_by_phone']);
    Route::any('payment/approval_student_list/by_manager/{id}', [StudentRequestController::class, 'payment_tuition_search_by_manager']);

    Route::get('payment_details/{id}', [StudentRequestController::class, 'payment_details']);

    Route::post('payment_submit/{id}', [StudentRequestController::class, 'payment_submit']);

    Route::get('transactions', [StudentRequestController::class, 'transactions'])->name('transactions');
    Route::post('transactions/edit/{id}', [StudentRequestController::class, 'update_transactions']);

    Route::post('approval_student_list/note/{id}', [StudentRequestController::class, 'add_note']);

    Route::get('student_tutor_request', [AllRequestController::class, 'studentTutorRequest'])->name('studentTutorRequest');
    Route::get('teacher_tuition_request', [AllRequestController::class, 'teacherTuitionRequest'])->name('SteacherTuitionRequest');
    Route::get('request-details/{id}', [AllRequestController::class, 'requestDetails'])->name('requestDetails');


    Route::get('/student/create', [StudentController::class, 'create']);
    Route::post('/student/store', [StudentController::class, 'store']);
    Route::get('/tuition/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/tuition/update', [StudentController::class, 'update']);

    Route::post('/search/name', [AdminSearchController::class, 'searchName'])->name('search.name');
    Route::post('/search/id', [AdminSearchController::class, 'searchId'])->name('search.id');
    Route::post('/search/institution', [AdminSearchController::class, 'searchInstitution'])->name('search.institution');
    Route::post('/search/phone-number', [AdminSearchController::class, 'searchPhoneNumber'])->name('search.phoneNumber');
    Route::post('/search/email-address', [AdminSearchController::class, 'searchEmailAddress'])->name('search.email');


    ///start/////

    Route::any('/search/results', [AdminSearchResultController::class, 'searchResult2'])->name('searchResult');
    Route::any('/search-by-edu-info/results', [AdminSearchResultController::class, 'searchResultByEdu'])->name('searchResultByEdu');

    Route::get('/membership', [MembershipController::class, 'index'])->name('membership');
    Route::get('/membership/create/{id}', [MembershipController::class, 'create'])->name('membership.create');
    Route::post('/membership/store', [MembershipController::class, 'store'])->name('membership.store');
    Route::get('/membership/edit/{id}', [MembershipController::class, 'edit'])->name('membership.edit');
    Route::post('/membership/update/{id}', [MembershipController::class, 'update'])->name('membership.update');
    Route::get('/membership/delete/{id}', [MembershipController::class, 'delete'])->name('membership.delete');
    Route::get('/sms', [MembershipController::class, 'sms'])->name('sms');


    Route::get('/alladdbalance', [BalanceController::class, 'index'])->name('alladdbalance');
    Route::get('/balance/create/{id}', [BalanceController::class, 'create'])->name('balance.create');
    Route::post('/balance/store/{id}', [BalanceController::class, 'store'])->name('balance.store');


    //=================Admin Slider Image============
    Route::get('/slider', [SliderImagesController::class, 'index'])->name('slideImages');
    Route::get('/slider/add', [SliderImagesController::class, 'create'])->name('slideImagesAdd');
    Route::post('/slider/store', [SliderImagesController::class, 'store'])->name('slideImagesStore');
    Route::get('/slider/edit/{id}', [SliderImagesController::class, 'edit'])->name('slideImagesEdit');
    Route::post('/slider/update/{id}', [SliderImagesController::class, 'update'])->name('slideImagesUpdate');
    Route::get('/slider/delete/{id}', [SliderImagesController::class, 'destroy'])->name('slideImagesDestroy');

    //=================Admin Ads Image============
    Route::get('/ads-images', [AdsImagesController::class, 'index'])->name('ads-images');
    Route::get('/ads-images/add', [AdsImagesController::class, 'create'])->name('ads-imagesAdd');
    Route::post('/ads-images/store', [AdsImagesController::class, 'store'])->name('ads-imagesStore');
    Route::get('/ads-images/edit/{id}', [AdsImagesController::class, 'edit'])->name('ads-imagesEdit');
    Route::post('/ads-images/update/{id}', [AdsImagesController::class, 'update'])->name('ads-imagesUpdate');
    Route::get('/ads-images/delete/{id}', [AdsImagesController::class, 'destroy'])->name('ads-imagesDestroy');

    Route::get('/receiver_list/{id}', [StudentRequestController::class, 'receiver_list'])->name('receiver_list');
    Route::get('/applied_receiver_list/{id}', [StudentRequestController::class, 'applied_receiver_list'])->name('applied_receiver_list');

    Route::post('/find_teacher', [StudentRequestController::class, 'find_teacher'])->name('find_teacher');
    Route::post('/assign_teacher', [StudentRequestController::class, 'assign_teacher'])->name('assign_teacher');
    Route::post('/confirm_teacher', [StudentRequestController::class, 'confirm_teacher'])->name('confirm_teacher');
    Route::post('/reject_teacher', [StudentRequestController::class, 'reject_teacher'])->name('reject_teacher');

    Route::post('/assigned_teacher/edit/{id}', [StudentRequestController::class, 'assign_teacher_edit'])->name('assign_teacher_edit');
    Route::post('/confirmed_teacher/edit/{id}', [StudentRequestController::class, 'confirmed_teacher_edit'])->name('confirmed_teacher_edit');




    Route::get('/all_manager', [AdminHomeController::class, 'all_manager'])->name('all_manager');
    Route::post('/add_manager', [AdminHomeController::class, 'add_manager'])->name('add_manager');
    Route::get('/edit_manager/{id}', [AdminHomeController::class, 'edit_manager_view'])->name('edit_manager_view');
    Route::post('/edit_manager/{id}', [AdminHomeController::class, 'edit_manager'])->name('edit_manager');
    Route::get('/delete_manager/{id}', [AdminHomeController::class, 'delete_manager'])->name('delete_manager');
    Route::get('/enable_manager/{id}', [AdminHomeController::class, 'enable_manager'])->name('enable_manager');

    Route::get('/disabled_manager_list', [AdminHomeController::class, 'deleted_manager'])->name('deleted_manager');

    Route::get('/apply_tuition_list/{id}', [AdminHomeController::class, 'applyTuitionList'])->name('user.apply_tuition_list');
    Route::get('/assigned_tuition_list/{id}', [AdminHomeController::class, 'assignedTuitionList'])->name('user.asssigned_tuition_list');
    Route::get('/confirmed_tuition_list/{id}', [AdminHomeController::class, 'confirmedTuitionList'])->name('user.confirmed_tuition_list');
    Route::get('/cancelled_tuition_list/{id}', [AdminHomeController::class, 'cancelledTuitionList'])->name('user.cancelled_tuition_list');


    Route::get('/notice/broadcast', [AdminHomeController::class, 'broadcast_notification'])->name('broadcastNotification');
    Route::post('/notice/broadcast', [AdminHomeController::class, 'broadcast_notification_post'])->name('broadcastNotificationPost');
    Route::get('/notice/individual', [AdminHomeController::class, 'individual_notice'])->name('individual_notice');

    Route::get('/all_text', [AdminHomeController::class, 'individual_notice'])->name('all_text');


    Route::get('/all-districts', [AllDistrictController::class, 'index']);
    Route::get('/all-districts/create', [AllDistrictController::class, 'create']);
    Route::post('/all-districts/store', [AllDistrictController::class, 'store']);
    Route::get('/all-districts/{id}/edit', [AllDistrictController::class, 'edit']);
    Route::post('/all-districts/{id}/update', [AllDistrictController::class, 'update']);
    Route::get('/all-districts/{id}/delete', [AllDistrictController::class, 'destroy']);

    Route::get('/all-area', [AllAreaController::class, 'index']);
    Route::get('/all-area/create', [AllAreaController::class, 'create']);
    Route::post('/all-area/store', [AllAreaController::class, 'store']);
    Route::get('/all-area/{id}/edit', [AllAreaController::class, 'edit']);
    Route::post('/all-area/{id}/update', [AllAreaController::class, 'update']);
    Route::get('/all-area/{id}/delete', [AllAreaController::class, 'destroy']);


    Route::get('/all-medium', [AllMediumController::class, 'index']);
    Route::get('/all-medium/create', [AllMediumController::class, 'create']);
    Route::post('/all-medium/store', [AllMediumController::class, 'store']);
    Route::get('/all-medium/{id}/edit', [AllMediumController::class, 'edit']);
    Route::post('/all-medium/{id}/update', [AllMediumController::class, 'update']);
    Route::get('/all-medium/{id}/delete', [AllMediumController::class, 'destroy']);

    Route::get('/any-class', [AllClassController::class, 'index']);
    Route::get('/any-class/create', [AllClassController::class, 'create']);
    Route::post('/any-class/store', [AllClassController::class, 'store']);
    Route::get('/any-class/{id}/edit', [AllClassController::class, 'edit']);
    Route::post('/any-class/{id}/update', [AllClassController::class, 'update']);
    Route::get('/any-class/{id}/delete', [AllClassController::class, 'destroy']);


    Route::get('/any-subject', [AnySubjectController::class, 'index']);
    Route::get('/any-subject/create', [AnySubjectController::class, 'create']);
    Route::post('/any-subject/store', [AnySubjectController::class, 'store']);
    Route::get('/any-subject/{id}/edit', [AnySubjectController::class, 'edit']);
    Route::post('/any-subject/{id}/update', [AnySubjectController::class, 'update']);
    Route::get('/any-subject/{id}/delete', [AnySubjectController::class, 'destroy']);


    Route::get('/salary-range', [SalaryRangeController::class, 'index']);
    Route::get('/salary-range/create', [SalaryRangeController::class, 'create']);
    Route::post('/salary-range/store', [SalaryRangeController::class, 'store']);
    Route::get('/salary-range/{id}/edit', [SalaryRangeController::class, 'edit']);
    Route::post('/salary-range/{id}/update', [SalaryRangeController::class, 'update']);
    Route::get('/salary-range/{id}/delete', [SalaryRangeController::class, 'destroy']);


    //University Routes
    Route::get('/institution_type', [InstTypeController::class, 'index']);
    Route::get('/institution_type/create', [InstTypeController::class, 'create']);
    Route::post('/institution_type/store', [InstTypeController::class, 'store']);
    Route::get('/institution_type/edit/{id}', [InstTypeController::class, 'edit']);
    Route::post('/institution_type/update/{id}', [InstTypeController::class, 'update']);
    Route::get('/institution_type/show/{id}', [InstTypeController::class, 'show']);
    Route::get('/institution_type/delete/{id}', [InstTypeController::class, 'destroy']);

    //University Routes
    Route::get('/university', [UniversityController::class, 'index']);
    Route::get('/university/create', [UniversityController::class, 'create']);
    Route::post('/university/store', [UniversityController::class, 'store']);
    Route::get('/university/edit/{id}', [UniversityController::class, 'edit']);
    Route::post('/university/update/{id}', [UniversityController::class, 'update']);
    Route::get('/university/show/{id}', [UniversityController::class, 'show']);
    Route::get('/university/delete/{id}', [UniversityController::class, 'destroy']);

    //Study Type Routes
    Route::get('/study_type', [StudyTypeController::class, 'index']);
    Route::get('/study_type/create', [StudyTypeController::class, 'create']);
    Route::post('/study_type/store', [StudyTypeController::class, 'store']);
    Route::get('/study_type/edit/{id}', [StudyTypeController::class, 'edit']);
    Route::post('/study_type/update/{id}', [StudyTypeController::class, 'update']);
    Route::get('/study_type/show/{id}', [StudyTypeController::class, 'show']);
    Route::get('/study_type/delete/{id}', [StudyTypeController::class, 'destroy']);

    //Department Routes
    Route::get('/department', [DepartmentController::class, 'index']);
    Route::get('/department/create', [DepartmentController::class, 'create']);
    Route::post('/department/store', [DepartmentController::class, 'store']);
    Route::get('/department/edit/{id}', [DepartmentController::class, 'edit']);
    Route::post('/department/update/{id}', [DepartmentController::class, 'update']);
    Route::get('/department/show/{id}', [DepartmentController::class, 'show']);
    Route::get('/department/delete/{id}', [DepartmentController::class, 'destroy']);


    Route::resource('/faq-data', FaqController::class);
    Route::resource('/howitworks-data', HowItWorksController::class);

    Route::get('/all_user', [HomeController::class, 'allUser'])->name('allUser');
    Route::get('/user/{id}', [HomeController::class, 'userView'])->name('userView');
    Route::post('/user-edit', [HomeController::class, 'userEdit'])->name('userEdit');
    Route::get('/contact', [replyContactController::class, 'contact'])->name('contact');
    Route::post('/reply-contact', [replyContactController::class, 'reply'])->name('reply');
    Route::get('/contact-delete/{id}', [ReplyContactController::class, 'contactDelete'])->name('contactDelete');
    Route::get('/admin-add', [AdminUserController::class, 'admin'])->name('admin');
    Route::post('/admin2', [AdminUserController::class, 'adminAdd'])->name('adminAdd');
    Route::get('/admin-list', [AdminUserController::class, 'adminList'])->name('adminList');
    Route::get('/admin-delete/{id}', [AdminUserController::class, 'adminDelete'])->name('adminDelete');
    Route::get('/tutor-list', [AdminUserController::class, 'tutorlist'])->name('tutorlist');
    Route::get('/tutor-list/delete/{id}', [AdminUserController::class, 'tutorDelete'])->name('tutorlist.delete');

    Route::get('/privacy-policy', [PrivacyPolicyController::class, 'create'])->name('create');
    Route::post('/privacy-policy/update/{id}', [privacyPolicyController::class, 'update'])->name('update');

    Route::get('/profile_verification_request', [AllRequestController::class, 'profile_verification_request'])->name('profile_verification_request');
    Route::get('/premium_profile_request', [AllRequestController::class, 'premium_profile_request'])->name('premium_profile_request');

    Route::any('/send_text', [HomeController::class, 'send_text'])->name('admin.send_text');
    Route::post('/send_bulk_text', [HomeController::class, 'send_bulk_text'])->name('admin.send_bulk_text');

    //===============Uddokta Management===================
    Route::get('/logout_managing', [LogoutController::class, 'logoutPage'])->name('admin.logoutPage');
    Route::get('/logout-all-admins', [LogoutController::class, 'logoutAllAdmins'])->name('admin.logoutAllAdmins');
    Route::get('/logout-all-managers', [LogoutController::class, 'logoutAllManagers'])->name('admin.logoutAllManagers');
    Route::get('/logout-admin/{id}', [LogoutController::class, 'logoutAdmin'])->name('admin.logoutAdmin');
    Route::get('/logout-manager/{id}', [LogoutController::class, 'logoutManager'])->name('admin.logoutManager');


    //===============Uddokta Management===================
    Route::get('/uddokta_list', [UddoktaController::class, 'list']);
    Route::get('/uddokta_details/{id}', [UddoktaController::class, 'details']);
    Route::get('/uddokta_status/{id}', [UddoktaController::class, 'status']);
    Route::post('/uddokta/make_payment/{id}', [UddoktaController::class, 'make_payment']);

    //===============Password Settings===================
    Route::get('reset_password', [LoginController::class, 'reset_pass_view'])->name('reset_password');
    Route::post('reset_password', [LoginController::class, 'resetPassword']);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/manager.php';

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/reboot', function () {
    $exitCode = Artisan::call('optimize:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    return '<h1>Optimized</h1>';
});
