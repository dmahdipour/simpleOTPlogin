<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showMobileForm'])->name('login');
Route::post('/login/check-mobile', [AuthController::class, 'checkMobile'])->name('login.checkMobile');
Route::get('/login/password', [AuthController::class, 'showPasswordForm'])->name('login.passwordForm');
Route::post('/login/password', [AuthController::class, 'loginWithPassword'])->name('login.password');
Route::get('/login/otp', [AuthController::class, 'showOtpForm'])->name('login.otpForm');
Route::post('/login/otp/send', [AuthController::class, 'sendOtp'])->middleware('throttle:3,1')->name('login.otpSend');
Route::post('/login/otp/verify', [AuthController::class, 'verifyOtp'])->name('login.otpVerify');

Route::get('/logout', [AuthController::class, 'showMobileForm'])->name('logout');

Route::get('/register/complete', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register/complete', [AuthController::class, 'storeUserData'])->name('register.store');

Route::get('/', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');