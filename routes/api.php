<?php

use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/', function () {
    return 'hello api';
});

Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:5,1');
Route::post('/login', LoginController::class)->middleware('throttle:10,1');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->middleware('throttle:5,1');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('throttle:5,1');