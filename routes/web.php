<?php

use App\Http\Controllers\api\v1\admin\FaqController;
use App\Http\Controllers\api\v1\admin\TicketController;
use App\Http\Controllers\api\v1\TicketController as ApiTicketController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\admin\AuthController as AuthAdmin;
use App\Http\Controllers\api\v1\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login-verify', [AuthController::class, 'login'])->name('login-verify');
Route::get('/otp-page', [AuthController::class, 'createOtp'])->name('otp-page');
Route::post('/otp', [AuthController::class, 'otp'])->name('otp');
//Route::post('/create-admin', [AuthController::class, 'createAdmin'])->name('createAdmin');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AuthController::class, 'dashboard'])->name('user-dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('ticket', ApiTicketController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AuthAdmin::class, 'create'])->name('login-form-admin');
    Route::post('/login', [AuthAdmin::class, 'login'])->name('login-admin');
    Route::middleware(['auth.admin'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::get('delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');
        Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
        Route::get('block-user/{id}', [UserController::class, 'block'])->name('block-user');
        Route::post('update-user/{id}', [UserController::class, 'update'])->name('update-user');
        Route::get('add-user', [UserController::class, 'create'])->name('add-user');
        Route::post('store-user', [UserController::class, 'store'])->name('store-user');
        Route::get('index-faq', [FaqController::class, 'index'])->name('index-faq');
        Route::post('store-faq', [FaqController::class, 'store'])->name('store-faq');
        Route::get('create-faq', [FaqController::class, 'create'])->name('create-faq');
        Route::post('update-faq/{id}', [FaqController::class, 'update'])->name('update-faq');
        Route::get('delete-faq/{id}', [FaqController::class, 'destroy'])->name('delete-faq');
        Route::get('edit-faq/{id}', [FaqController::class, 'edit'])->name('edit-faq');

        Route::get('index-ticket', [TicketController::class, 'index'])->name('index-ticket');
        Route::post('update-ticket/{id}', [TicketController::class, 'update'])->name('update-ticket');
        Route::get('edit-ticket/{id}', [TicketController::class, 'edit'])->name('edit-ticket');
    });
});
