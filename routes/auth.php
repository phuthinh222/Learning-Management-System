<?php

use App\Http\Controllers\Web\Authentication\Google\GoogleController;
use App\Http\Controllers\Web\Authentication\LoginController;
use App\Http\Controllers\Web\Authentication\RegisterController;

// Guest routes
Route::group([
    'middleware' => ['guest']
], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/auth/google', [GoogleController::class, 'index'])->name('google_index');
    Route::get('/auth/google/callback', [GoogleController::class, 'callBack'])->name('google_callback');
});

// Web routes
Route::group([
    'middleware' => ['web']
], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/verify/{id}', [RegisterController::class, 'verifyEmailToken'])->name('email_verify');
    Route::get('/verify/resendEmail', [RegisterController::class, 'resendEmailVerification']);
    Route::group([
        'middleware' => ['VerifyEmail']
    ], function () {
        Route::get('/verify/{id}', [RegisterController::class, 'verifyEmail'])->name('email_verify');

    });
});