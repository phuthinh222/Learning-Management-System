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
        //Route to manage Teacher:
        Route::prefix('teacher')->group(function() {
            Route::get('/inactive', [TeacherController::class, 'listInactiveTeacher'])->name('teacher.inactive');
            Route::post('/confirm/{id}', [TeacherController::class, 'confirmTeacherInformation'])->name('teacher.confirmation');
            Route::get('/getCertificate/{id}', [TeacherController::class, 'listCertificatesOfTeacher'])->name('teacher_certificates');
            Route::get('/getExperience/{id}', [TeacherController::class, 'listExperiencesOfTeacher'])->name('teacher_experiences');
        });

        //Route to manage User:
        Route::get('/user/listuser', [UserController::class, 'listUsers'])->name('user.listuser');
        Route::get('/filter/getDetails', [UserController::class, 'getSubjectsForFilter'])->name('getFilterDetails');
        Route::post('user/store', [UserController::class, 'store'])->name('users.store');
        Route::delete('user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
