<?php

use App\Http\Controllers\Web\Authentication\Google\GoogleController;
use App\Http\Controllers\Web\Authentication\LoginController;
use App\Http\Controllers\Web\Authentication\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth:web']
], function() {
    Route::get('/dashboard', [BaseController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group([
    'middleware' => ['guest']
], function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginStore'])->name('login_store');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerStore'])->name('register_store');
    Route::get('/auth/google', [GoogleController::class, 'index'])->name('google_index');
    Route::get('/auth/google/callback', [GoogleController::class, 'callBack'])->name('google_callback');
});