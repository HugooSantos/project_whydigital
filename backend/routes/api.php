<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/users', [UserController::class, 'createUser']);
Route::post('auth/login', [AuthController::class, 'login']);