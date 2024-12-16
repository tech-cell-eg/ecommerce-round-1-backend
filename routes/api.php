<?php

use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Middleware\API\CatchErrorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/', function () {
    return 'hello api';
});

Route::group(['middleware' => CatchErrorsMiddleware::class], function () {
    Route::post('/register', RegisterController::class)->middleware('throttle:5,1');
    Route::post('/login', LoginController::class)->middleware('throttle:10,1');
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->middleware('throttle:5,1');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('throttle:5,1');
});
