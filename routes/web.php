<?php

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login.form');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showMobileForm')->name('login.form');
    Route::post('/login', 'sendOtp')->name('login.send');
    
    Route::get('/login/otp', 'showOtpForm')->name('otp.form');
    Route::post('/login/otp', 'verifyOtp')->name('otp.verify');

    Route::get('/login/password', 'passwordForm')->name('password.form');
    Route::post('/login/password', 'passwordVerify')->name('password.verify');

    Route::get('/register', 'showRegisterForm')->name('register.form');
    Route::post('/register', 'storeUserData')->name('register.store');

    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/dashboard', fn() => view('Auth.dashboard'))
    ->middleware('auth')
    ->name('dashboard');