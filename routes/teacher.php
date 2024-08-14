<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Teacher']], function () {
    Route::resource('/teacher', TeacherController::class);
    Route::post('/teacher/{teacher}/certificate', [CertificateController::class, 'create'])->name('teacher_certificate');
    Route::post('/teacher/{teacher}/experiences', [ExperienceController::class, 'create'])->name('teacher_experiences');
});
