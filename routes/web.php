<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\CreatePinController;

Auth::routes(['Login' => false, 'register' => false]);

Route::redirect('/', 'login');

Route::post('findStudent', [StudentLoginController::class, 'findStudent'])->name('findStudent');

Route::get('login', [StudentLoginController::class, 'index'])->name('login');

Route::get('auto-logout', [StudentLoginController::class, 'autologout'])->name('autologout');

Route::post('validatePhoneNumber', [StudentLoginController::class, 'validatePhoneNumber']);

Route::get('pin/{parent_mobile_number}', [StudentLoginController::class, 'pin']);

Route::get('change-pin/{parent_mobile_number}', [StudentLoginController::class, 'changePin']);

Route::post('attemptParentLogin', [StudentLoginController::class, 'attemptParentLogin']);

Route::get('forgot-pin', [CreatePinController::class, 'createPin'])->name('forgotPin');

Route::post('send-otp', [CreatePinController::class, 'sendOtp'])->name('send_otp');

Route::get('confirm-otp', [CreatePinController::class, 'confirmOtp'])->name('confirmOtp');

Route::post('confirm-otp/{token}', [CreatePinController::class, 'matchOtp'])->name('matchOtp');

Route::get('reset-pin/{token}', [CreatePinController::class, 'resetPinForm'])->name('resetPin');

Route::post('reset-pin/{token}', [CreatePinController::class, 'resetPin'])->name('resetPinPost');

Route::get('create-pin', [CreatePinController::class, 'createPin'])->name('createPin');

Route::get('dashboard', [UserController::class, 'dashboard']);

Route::group(['middleware' => ['student']], function () {

    Route::get('student-login-table', [StudentLoginController::class, 'studentLoginTable']);

    Route::post('student-login', [StudentLoginController::class, 'login'])->name('slogin');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
