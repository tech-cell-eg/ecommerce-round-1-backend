<?php

use App\Http\Controllers\OurNewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Middleware\API\CatchErrorsMiddleware;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\InstagramStoriesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function () {
    return 'hello api';
});

Route::group(['middleware' => CatchErrorsMiddleware::class], function () {
    Route::post('/register', RegisterController::class)->middleware('throttle:5,1');
    Route::post('/login', LoginController::class)->middleware('throttle:10,1');
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::post('/forgot-password', ForgotPasswordController::class)->middleware('throttle:5,1');
    Route::post('/reset-password', ResetPasswordController::class)->middleware('throttle:5,1');
});

Route::apiResource('product', ProductController::class);
Route::get('products/search', [ProductController::class, 'search']);

Route::post('favorites', [FavoriteController::class, 'store'])->middleware(['auth:sanctum']); // Add favorite
Route::get('favorites', [FavoriteController::class, 'index'])->middleware(['auth:sanctum']);; // List favorites
Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy'])->middleware(['auth:sanctum']); // Remove favorite


Route::apiResource("categories", CategoryController::class);

Route::apiResource('/testimonial', TestimonialController::class);

Route::post('/our-news', OurNewsController::class);

// Route::group(['middleware'=> 'auth:sanctum'],function(){
//     Route::apiResource('/testimonial', TestimonialController::class);
// });



Route::get("instagram-stories", [InstagramStoriesController::class, "index"]);