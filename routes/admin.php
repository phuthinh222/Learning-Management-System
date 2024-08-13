<?php 

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Admin']], function () {

    // Logout route

    // Route::resource('/teacher', TeacherController::class);

    Route::resource('/admin', AdminController::class);

    Route::prefix('admin')->group(function () {
        Route::resource('/student', StudentController::class);

        Route::get('/teacher/inactive', [TeacherController::class, 'listInactiveTeacher'])->name('teacher.inactive');
        Route::get('/user/listuser', [UserController::class, 'listUsers'])->name('user.listuser');
    });
}); 