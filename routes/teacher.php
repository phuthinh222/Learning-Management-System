<?php

use App\Http\Controllers\AttendancesTeacherController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Teacher', 'MustVerifyEmail']], function () {
    //manage teacher verified
    Route::group(['middleware' => ['MustVerifyTeacher']], function(){
        Route::get('teacher/list_timekeeping', [TeacherController::class, 'listTimeKeeping'])->name('teacher.listTimeKeeping');
        Route::get('teacher/checkin_teacher', [AttendancesTeacherController::class, 'checkin_teacher'])->name('teacher.checkin_teacher');
        Route::get('teacher/checkout_teacher', [AttendancesTeacherController::class, 'checkout_teacher'])->name('teacher.checkout_teacher');
        Route::get('teacher/attendance/search', [AttendancesTeacherController::class, 'attendance_search'])->name('attendance.search');
        Route::get('teacher/table_timekeeping', [TeacherController::class, 'table_timekeeping'])->name('teacher.table_timekeeping');
    });

    Route::resource('/teacher', TeacherController::class);
    Route::prefix('teacher/')->group(function () {
        Route::resource('{teacher}/experiences', ExperienceController::class);
        Route::resource('{teacher}/certificates', CertificateController::class);
        
    });
});
