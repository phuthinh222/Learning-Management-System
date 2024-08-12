<?php

use App\Http\Controllers\Web\Authentication\Google\GoogleController;
use App\Http\Controllers\Web\Authentication\LoginController;
use App\Http\Controllers\Web\Authentication\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

// Authentication
Route::group([
    'middleware' => ['auth:web']
], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
    Route::resource('/admin', AdminController::class);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Manager Student routes
    Route::prefix('admin')->group(function () {
        Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
    });
});

// Guest routes
Route::group([
    'middleware' => ['guest']
], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginStore'])->name('login_store');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerStore'])->name('register_store');
    Route::get('/verify/{id}', [RegisterController::class, 'showVerify'])->name('email_verify');
    Route::post('/verify/{id}', [RegisterController::class, 'emailVerifyStore'])->name('email_verify_store');
    Route::get('/auth/google', [GoogleController::class, 'index'])->name('google_index');
    Route::get('/auth/google/callback', [GoogleController::class, 'callBack'])->name('google_callback');
});
