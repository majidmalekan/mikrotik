<?php

use App\Http\Controllers\api\v1\admin\MikroTikController;
use App\Http\Controllers\api\v1\AuthController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/mikrotik/user', [MikroTikController::class, 'addUser']);
Route::get('/mikrotik/identity', [AuthController::class, 'getData']);
//Route::get('/mikrotik/mac-address', [MikroTikController::class, 'getUserMAC']);
//Route::get('/mikrotik/traffic', [MikroTikController::class, 'getTraffic']);
//Route::post('/mikrotik/block-access', [MikroTikController::class, 'blockAccess']);
