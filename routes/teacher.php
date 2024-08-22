<?php

use App\Http\Controllers\AttendancesTeacherController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Teacher', 'MustVerifyEmail']], function () {
    Route::group(['prefix' => 'teacher', 'as' => 'teacher.'], function () {
        //manage teacher verified
        Route::group(['middleware' => ['MustVerifyTeacher']], function () {
            Route::get('list_timekeeping', [TeacherController::class, 'listTimeKeeping'])->name('listTimeKeeping');
            Route::get('checkin_teacher', [AttendancesTeacherController::class, 'checkin_teacher'])->name('checkin_teacher');
            Route::get('checkout_teacher', [AttendancesTeacherController::class, 'checkout_teacher'])->name('checkout_teacher');
            Route::get('attendance/search', [AttendancesTeacherController::class, 'attendance_search'])->name('attendance.search');
            Route::get('table_timekeeping', [TeacherController::class, 'table_timekeeping'])->name('table_timekeeping');
        });

        Route::resource('{teacher}/experiences', ExperienceController::class);
        Route::resource('{teacher}/certificates', CertificateController::class);
        Route::resource('{teacher}/courses', CoursesController::class);

        Route::resource('/', TeacherController::class)->parameters(['' => 'teacher']);
    });
});
