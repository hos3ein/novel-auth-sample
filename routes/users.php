<?php

use App\Http\Controllers\UsersOtpGeneratorController;
use App\Http\Controllers\UsersProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/otp-generator', [UsersOtpGeneratorController::class, 'index'])
        ->name('otp-generator');
    Route::post('/otp-generator', [UsersOtpGeneratorController::class, 'store'])
        ->name('otp-generator.store');
});

Route::get('/profile', [UsersProfileController::class, 'index'])
    ->middleware('auth')->name('profile');
Route::post('/profile', [UsersProfileController::class, 'store'])
    ->middleware('auth')->name('profile.store');
