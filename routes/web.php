<?php

use App\Http\Controllers\Web\Authentication\Google\GoogleController;
use App\Http\Controllers\Web\Authentication\LoginController;
use App\Http\Controllers\Web\Authentication\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;


// Authentication Routes
Route::middleware(['auth:web'])->group(function () {

    // Logout route
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::view('/', 'admin.index');
    Route::view('/dashboard', 'admin.index')->name('dashboard');
    
    Route::resource('/teacher', TeacherController::class);

    Route::resource('/admin', AdminController::class);

    Route::prefix('admin')->group(function () {
        Route::resource('/student', StudentController::class);

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
    Route::get('/verify', [RegisterController::class, 'showVerify'])->name('email_verify');
    Route::post('/verify/{id}', [RegisterController::class, 'emailVerifyStore'])->name('email_verify_store');
    Route::get('/auth/google', [GoogleController::class, 'index'])->name('google_index');
    Route::get('/auth/google/callback', [GoogleController::class, 'callBack'])->name('google_callback');
});
