<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Admin', 'MustVerifyEmail']], function () {

    // Logout route

    Route::resource('/admin', AdminController::class);

    Route::prefix('admin')->group(function () {
        Route::resource('/student', StudentController::class);

        Route::get('/teacher/inactive', [TeacherController::class, 'listInactiveTeacher'])->name('teacher.inactive');
        Route::get('/user/listuser', [UserController::class, 'listUsers'])->name('user.listuser');
        Route::get('/filter/getDetails', [UserController::class, 'getSubjectsForFilter'])->name('getFilterDetails');
        Route::post('user/store', [UserController::class, 'store'])->name('users.store');
    });
});
