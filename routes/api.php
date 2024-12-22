<?php

use App\Http\Controllers\API\Address\UserAddressController;
use App\Http\Controllers\API\Auth\SocialLoginController;
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
use App\Http\Controllers\CartController;
use App\Http\Controllers\InstagramStoriesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OurNewsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => CatchErrorsMiddleware::class], function () {
    Route::middleware(['api', 'web'])->group(function () {
        Route::get('/{provider}-login', [SocialLoginController::class, 'providerAuth']);
        Route::get('/{provider}-callback', [SocialLoginController::class, 'providerCallback']);
    });
    Route::post('/register', RegisterController::class)->middleware('throttle:5,1');
    Route::post('/login', LoginController::class)->middleware('throttle:10,1');
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::post('/forgot-password', App\Http\Controllers\API\Auth\ForgotPasswordController::class)->middleware('throttle:5,1');
    Route::post('/reset-password', ResetPasswordController::class)->middleware('throttle:5,1');

    Route::apiResource('addresses', UserAddressController::class)->middleware('auth:sanctum');
});

Route::apiResource('product', ProductController::class);
Route::get('products/search', [ProductController::class, 'search']);

Route::get('favorites', [FavoriteController::class, 'index'])->middleware(['auth:sanctum']);; // List favorites
Route::post('favorites', [FavoriteController::class, 'store'])->middleware(['auth:sanctum']);;// Add favorite
Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy'])->middleware(['auth:sanctum']); // Remove favorite


Route::apiResource("categories", CategoryController::class);

Route::apiResource('/testimonial', TestimonialController::class);
Route::post('/our-news', OurNewsController::class);

Route::apiResource("reviews", ReviewController::class);
Route::get("instagram-stories", [InstagramStoriesController::class, "index"]);
Route::apiResource("cart", CartController::class);

Route::get("notifications", [NotificationController::class, "index"]);