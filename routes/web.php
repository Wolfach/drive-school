<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriveSchoolController;
use App\Http\Controllers\NewAuthController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('register', [NewAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [NewAuthController::class, 'register']);
Route::get('login', [NewAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [NewAuthController::class, 'login']);
Route::post('logout', [NewAuthController::class, 'logout'])->name('logout');


Route::get('/', [DriveSchoolController::class, 'index'])->name('home');

require __DIR__.'/settings.php';
