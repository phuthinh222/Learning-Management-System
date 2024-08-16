<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExperienceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Models\Experience;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Teacher']], function () {

    Route::resource('/teacher', TeacherController::class);

    Route::prefix('teacher/{teacher}')->group(function () {
        Route::resource('/experiences', ExperienceController::class);
        Route::resource('/certificates', CertificateController::class);
    });
});
