<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


// Authentication Routes
Route::group(['middleware' => ['auth', 'role:Student', 'MustVerifyEmail']], function () {
    Route::resource('/student', StudentController::class);
});
