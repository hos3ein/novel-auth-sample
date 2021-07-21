<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admins'])->as('admins.')->prefix('/admins')->group(function () {
    Route::get('/dashboard', function () {
        return view('admins.dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('admins.profile');
    })->name('profile');
});
