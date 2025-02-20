<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'redirect.role'])->group(function () {
    Route::get('/');
    Route::get('/home')->name('home');
    Route::get('/dashboard')->name('dashboard');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/teacher.php';
require __DIR__ . '/student.php';
require __DIR__ . '/employee.php';
