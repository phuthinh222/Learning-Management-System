<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Admin', 'MustVerifyEmail']], function () {

    Route::prefix('admin')->group(function () {
     
        Route::prefix('teacher')->group(function() {
            Route::get('/inactive', [TeacherController::class, 'listInactiveTeacher'])->name('teacher.inactive');
            Route::get('/inactive/search', [TeacherController::class, 'listInactiveTeacher'])->name('teacher.search');
            Route::post('/confirm/{id}', [TeacherController::class, 'confirmTeacherInformation'])->name('teacher.confirmation');
            Route::get('/getCertificate/{id}', [TeacherController::class, 'listCertificatesOfTeacher'])->name('teacher_certificates');
            Route::get('/getExperience/{id}', [TeacherController::class, 'listExperiencesOfTeacher'])->name('teacher_experiences');
        });

        //Route to manage User:
        Route::get('/user/listuser', [UserController::class, 'listUsers'])->name('user.listuser');
        Route::get('/filter/getDetails', [UserController::class, 'getSubjectsForFilter'])->name('getFilterDetails');
        Route::post('user/store', [UserController::class, 'store'])->name('users.store');
        Route::delete('user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/table_timekeeping', [AdminController::class, 'table_timekeeping_list_teacher'])->name('admin.table_timekeeping');
      
    });

    Route::resource('/admin', AdminController::class);
});
