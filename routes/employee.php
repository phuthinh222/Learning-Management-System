<?php

use App\Http\Controllers\TeacherController;

Route::group(['middleware' => ['auth', 'role:Employee', 'MustVerifyEmail']], function () {

Route::prefix('employee')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('employee.index');
});
}); 