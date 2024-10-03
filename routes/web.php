<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\admin\AuthController as AuthAdmin;
use App\Http\Controllers\api\v1\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'create'])->name('login-form');
Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::prefix('admin')->group(function () {
    Route::get('/', [AuthAdmin::class, 'create'])->name('login-form-admin');
    Route::post('/login', [AuthController::class, 'store'])->name('login-admin');
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthAdmin::class, 'index'])->name('dashboard');
        Route::get('delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');
        Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
    });
});
