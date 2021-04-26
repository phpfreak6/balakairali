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

/* * ***= TEACHER ROUTES =***** */

Route::group(['middleware' => ['auth', 'teacher'], 'prefix' => 'teacher', 'as' => 'teacher.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


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
    Route::match(['get', 'post'], 'payment/report', [ReportsController::class, 'paymentReport'])->name('paymentReport');

    Route::get('payment/invoice/{id}', [ReportsController::class, 'generateInvoice'])->name('generateInvoice');
    Route::get('payment/mail-invoice/{id}', [ReportsController::class, 'mailInvoice'])->name('mailInvoice');


    //Login - logout

    Route::match(['get', 'post'], 'signin-signout', [SignController::class, 'index'])->name('signinSignout');

    // Teachers Resource


    Route::get('teachers-resource', [TeacherResourceController::class, 'index'])->name('resourceIndex');

    Route::post('uploads', [TeacherResourceController::class, 'upload'])->name('upload');
    Route::post('fetch-resources', [TeacherResourceController::class, 'index'])->name('resources');
});
?>