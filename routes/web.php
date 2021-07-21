<?php

use App\Http\Controllers\ConfigsController;
use App\Http\Controllers\ShowOtpCodesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/locale/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'fa']))
        abort(400);
    Session::put('locale', $locale);
    return back();
});

// Session based configs. Just for test NovelAuth package.
Route::get('/configs', [ConfigsController::class, 'index'])->name('configs');
Route::post('/configs', [ConfigsController::class, 'store'])->name('configs.store');

// Just for test NovelAuth package.
Route::get('/show-otp-codes', [ShowOtpCodesController::class, 'index'])->name('show-otp-codes');
Route::post('/show-otp-codes', [ShowOtpCodesController::class, 'store'])->name('show-otp-codes.store');

require_once 'admins.php';
require_once 'users.php';
