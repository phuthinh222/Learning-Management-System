<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'redirect.role'])->group(function () {
    Route::get('/', function () {});
    Route::get('/home', function () {})->name('home');
    Route::get('/dashboard', function () {})->name('dashboard');
});




require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/teacher.php';
