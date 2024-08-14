<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Teacher']], function () {
    Route::get('teacher/list_timekeeping',[TeacherController::class , 'listTimeKeeping'])->name('teacher.listTimeKeeping');
    Route::resource('/teacher', TeacherController::class);       
});
