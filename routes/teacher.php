<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Teacher']], function () {
    Route::resource('/teacher', TeacherController::class);
});
