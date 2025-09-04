<?php

use Illuminate\Support\Facades\Route;
use AgusUsk\AdminLteAuth\Http\Controllers\LoginController;
use AgusUsk\AdminLteAuth\Http\Controllers\RegisterController;
use AgusUsk\AdminLteAuth\Http\Controllers\ForgotPasswordController;
use AgusUsk\AdminLteAuth\Http\Controllers\ProfileController;

// Guest routes
// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
if (config('adminlte-auth.enable_registration', true)) {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('adminlte.register');
    Route::post('/register', [RegisterController::class, 'register']);
}

// Password Reset
if (config('adminlte-auth.enable_password_reset', true)) {
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('adminlte.password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('adminlte.password.reset');
    Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('adminlte.password.update');
}

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});