<?php

use App\Http\Controllers\AttendancesTeacherController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Teacher', 'MustVerifyEmail']], function () {
    Route::get('teacher/list_timekeeping',[TeacherController::class , 'listTimeKeeping'])->name('teacher.listTimeKeeping');
    Route::get('teacher/checkin_teacher',[AttendancesTeacherController::class , 'checkin_teacher'])->name('teacher.checkin_teacher');
    Route::get('teacher/checkout_teacher',[AttendancesTeacherController::class , 'checkout_teacher'])->name('teacher.checkout_teacher');
    Route::get('teacher/attendance/search', [AttendancesTeacherController::class, 'attendance_search'])->name('attendance.search');
    Route::post('/teacher/{teacher}/certificate', [CertificateController::class, 'create'])->name('teacher_certificate');
    Route::post('/teacher/{teacher}/experiences', [ExperienceController::class, 'create'])->name('teacher_experiences');
    Route::resource('/teacher', TeacherController::class);
    
});
