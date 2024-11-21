<?php

use App\Http\Controllers\api\v1\admin\MikroTikController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\admin\AuthController as AuthAdmin;
use App\Http\Controllers\api\v1\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'create'])->name('login-form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/otp-page', [AuthController::class, 'createOtp'])->name('otp-page');
Route::post('/otp', [AuthController::class, 'otp'])->name('otp');
Route::post('/create-admin', [AuthController::class, 'createAdmin'])->name('createAdmin');
Route::get('/dashboard/{id}', [AuthController::class, 'dashboard'])->name('user-dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/', [AuthAdmin::class, 'create'])->name('login-form-admin');
    Route::post('/login', [AuthAdmin::class, 'login'])->name('login-admin');
    Route::middleware(['auth.admin'])->group(function () {
        Route::get('/mikrotik/identity', [MikroTikController::class, 'getSystemIdentity']);
        Route::post('/mikrotik/user', [MikroTikController::class, 'addUser']);
        Route::get('/mikrotik/mac-address', [MikroTikController::class, 'getUserMAC']);
        Route::get('/mikrotik/traffic', [MikroTikController::class, 'getTraffic']);
        Route::post('/mikrotik/block-access', [MikroTikController::class, 'blockAccess']);
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::get('delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');
        Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
        Route::get('update-user/{id}', [UserController::class, 'edit'])->name('update-user');
        Route::get('add-user', [UserController::class, 'create'])->name('add-user');
        Route::post('store-user', [UserController::class, 'store'])->name('store-user');
    });
});
