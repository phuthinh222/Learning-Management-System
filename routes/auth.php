<?php

use App\Http\Controllers\Web\Authentication\Google\GoogleController;
use App\Http\Controllers\Web\Authentication\LoginController;
use App\Http\Controllers\Web\Authentication\RegisterController;

// Guest routes
Route::group([
    'middleware' => ['guest']
], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginStore'])->name('login_store');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerStore'])->name('register_store');
    Route::get('/verify', [RegisterController::class, 'showVerify'])->name('email_verify');
    Route::post('/verify/{id}', [RegisterController::class, 'emailVerifyStore'])->name('email_verify_store');
    Route::get('/auth/google', [GoogleController::class, 'index'])->name('google_index');
    Route::get('/auth/google/callback', [GoogleController::class, 'callBack'])->name('google_callback');
});

// Web routes
Route::group([
    'middleware' => ['web']
], function () {
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});