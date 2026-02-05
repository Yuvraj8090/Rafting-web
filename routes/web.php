<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RaftDriverController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\DailyTripController;
use App\Http\Controllers\AdminDashboardController;

// Welcome Page

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('drivers', RaftDriverController::class);
    Route::resource('boats', BoatController::class);
    Route::get('/verify/driver', [DailyTripController::class, 'showScanner'])->name('verifier.dash');
    Route::post('/verify/check-driver', [DailyTripController::class, 'verifyDriver'])->name('verifier.check');
    Route::post('/verify/complete-trip', [DailyTripController::class, 'store'])->name('verifier.store');
});
