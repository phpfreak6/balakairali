<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\StudentsController;
use App\Http\Controllers\Backend\CentresController;
use App\Http\Controllers\Backend\ClassesController;
use App\Http\Controllers\Backend\TeachersController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\ReportsController;
use App\Http\Controllers\Backend\SignController;
use App\Http\Controllers\Backend\TeacherResourceController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\AssignController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/* ADMIN ROUTES */

Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login.form');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('password/reset', [ForgotPasswordController::class, 'sendLink'])->name('admin.reset');
Route::get('account-password/reset', [ForgotPasswordController::class, 'resetFrom'])->name('admin.resetform');
Route::get('account-password', [ForgotPasswordController::class, 'resentLink'])->name('admin.sentmail')->middleware(['revalidate']);
Route::post('update-password/{token}', [ForgotPasswordController::class, 'updatePassword'])->name('admin.password.update');
Route::group(['middleware' => ['auth', 'role:admin|teacher'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile/setting', [ProfileController::class, 'setting'])->name('profile.setting');
    Route::post('/change-passwprd', [ProfileController::class, 'changePassword'])->name('changePass');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    //Teachers
    Route::get('teachers', [TeachersController::class, 'index'])->name('teachers');
    Route::post('teachers-list', [TeachersController::class, 'index'])->name('teachers-list');
    Route::post('teachers/deleteTeacher', [TeachersController::class, 'deleteTeacher']);
    Route::get('teacher/create', [TeachersController::class, 'create'])->name('teachers.create');
    Route::post('teacher/store', [TeachersController::class, 'store'])->name('teachers.store');
    Route::get('teacher/edit/{id}', [TeachersController::class, 'edit'])->name('teachers.edit');
    Route::get('teacher/show/{id}', [TeachersController::class, 'show'])->name('teachers.show');
    Route::post('teacher/update/{id}', [TeachersController::class, 'update'])->name('teachers.update');
    Route::get('teacher/delete/{id}', [TeachersController::class, 'destroy'])->name('teachers.delete');
    Route::post('teacher/change/status', [TeachersController::class, 'accountStatus'])->name('teacher.accountStatus');

    //Students
    Route::get('students', [StudentsController::class, 'index'])->name('students');
    Route::post('students-list', [StudentsController::class, 'index'])->name('student-list');
    Route::get('students/create', [StudentsController::class, 'create'])->name('student.create');
    Route::post('students/store', [StudentsController::class, 'store'])->name('student.store');
    Route::get('student/edit/{id}', [StudentsController::class, 'edit'])->name('student.edit');
    Route::get('student/show/{id}', [StudentsController::class, 'show'])->name('student.show');
    Route::post('student/update/{id}', [StudentsController::class, 'update'])->name('student.update');
    Route::get('student/delete/{id}', [StudentsController::class, 'destroy'])->name('student.delete');
    Route::post('student/mark-paid', [StudentsController::class, 'markPaid'])->name('student.markPaid');
    Route::post('student/change/status', [StudentsController::class, 'accountStatus'])->name('student.accountStatus');
    Route::post('student/marks-store', [StudentsController::class, 'studentMarks'])->name('student.storeMarks');
    Route::post('student/progress-report/{id}', [StudentsController::class, 'studentProgress'])->name('student.studentProgress');
    Route::get('load_classes_create', [StudentsController::class, 'loadClasses']);
    Route::get('login-kids', [StudentsController::class, 'studentSigninSignout'])->name('studentSignin');

    //Centres
    Route::get('centres', [CentresController::class, 'index'])->name('centres');
    Route::post('centres-list', [CentresController::class, 'index'])->name('centres-list');
    Route::get('centres/create', [CentresController::class, 'create'])->name('centre.create');
    Route::post('centres/store', [CentresController::class, 'store'])->name('centre.store');
    Route::get('centre/edit/{id}', [CentresController::class, 'edit'])->name('centre.edit');
    Route::post('centre/update/{id}', [CentresController::class, 'update'])->name('centre.update');
    Route::get('centre/delete/{id}', [CentresController::class, 'destroy'])->name('centre.delete');
    //Classes

    Route::get('classes', [ClassesController::class, 'index'])->name('classes');
    Route::post('classes-list', [ClassesController::class, 'index'])->name('classes-list');
    Route::get('classes/create', [ClassesController::class, 'create'])->name('class.create');
    Route::post('classes/store', [ClassesController::class, 'store'])->name('class.store');
    Route::get('class/edit/{id}', [ClassesController::class, 'edit'])->name('class.edit');
    Route::post('class/update/{id}', [ClassesController::class, 'update'])->name('class.update');
    Route::get('class/delete/{id}', [ClassesController::class, 'destroy'])->name('class.delete');

    //attendance

    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('attendance', [AttendanceController::class, 'index'])->name('attendancelist');
    Route::post('show-student-list', [AttendanceController::class, 'showStudentList'])->name('showStudentList');
    Route::post('mark/attendance', [AttendanceController::class, 'markAttend'])->name('markAttendance');

    //Reports

    Route::match(['get', 'post'], 'attendance/report', [ReportsController::class, 'attendanceReport'])->name('attendanceReport');
    Route::match(['get', 'post'], 'payment-reports/index', [ReportsController::class, 'paymentReport'])->name('paymentReport');
    Route::post('payment-reports/getPaymentReportsDatatable', [ReportsController::class, 'getPaymentReportsDatatable']);
    Route::get('payment/invoice/{id}', [ReportsController::class, 'generateInvoice'])->name('generateInvoice');
    Route::get('payment/mail-invoice/{id}', [ReportsController::class, 'mailInvoice'])->name('mailInvoice');
    Route::post('attendance/totalClasses', [ReportsController::class, 'totalClasses']);

    //Login - logout
    Route::match(['get', 'post'], 'sign-records/index', [SignController::class, 'index'])->name('signinSignout');
    Route::get('signin-signout-kids', [SignController::class, 'signinSignout'])->name('signinSignoutKids');
    Route::get('load-kids-signin', [SignController::class, 'loadForSigninOut']);

    // Teachers Resource
    Route::get('teachers-resource', [TeacherResourceController::class, 'index'])->name('resourceIndex');
    Route::get('teacher-resources/delete-resource/{id}', [TeacherResourceController::class, 'deleteResource']);
    Route::post('uploads', [TeacherResourceController::class, 'upload'])->name('upload');
    Route::post('fetch-resources', [TeacherResourceController::class, 'index'])->name('resources');

    //Settings
    Route::get('settings', [SettingsController::class, 'settings'])->name('settings');
    Route::post('update-settings', [SettingsController::class, 'updateSettings'])->name('update.settings');

    //Ajax Load partials
    Route::get('load_classes', [ClassesController::class, 'loadClasses'])->name('loadClasses');
    Route::get('load_edit_classes', [ClassesController::class, 'loadeEditClasses'])->name('loadEditClasses');


    // Assign Kids
    Route::get('student/assign/{number}', [AssignController::class, 'assignKids'])->name('assign-kids');
    Route::get('load-parent-list', [AssignController::class, 'loadList'])->name('parent-list');
    Route::post('kids-assign', [AssignController::class, 'assign'])->name('kids-assign');
    Route::post('kids-unassign', [AssignController::class, 'unassign'])->name('kids-unassign');
});
