<?php

use App\Http\Controllers\TeacherController;

Route::group(['middleware' => ['auth', 'role:Teacher']], function () {

Route::prefix('teacher')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');
});
}); 