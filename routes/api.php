<?php

use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Auth\SocialLoginController;
use App\Http\Controllers\API\Cart\CartController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Favorite\FavoriteController;
use App\Http\Controllers\API\InstagramStory\InstagramStoriesController;
use App\Http\Controllers\API\OurNews\OurNewsController;
use App\Http\Controllers\API\Product\ProductController;
use App\Http\Controllers\API\Review\ReviewController;
use App\Http\Controllers\API\Testimonial\TestimonialController;
use App\Http\Controllers\API\UserCard\UserCardController;
use App\Http\Controllers\API\UserSetting\UserSettingController;
use App\Http\Middleware\API\CatchErrorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('/forgot-password', ForgotPasswordController::class)->middleware('throttle:5,1');
    Route::post('/reset-password', ResetPasswordController::class)->middleware('throttle:5,1');

    Route::get('/cards', [UserCardController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/cards/store', [UserCardController::class, 'store'])->middleware('auth:sanctum');
    Route::delete('/cards/{userCard}', [UserCardController::class, 'destroy'])->middleware('auth:sanctum');

    Route::get('/user-settings', [UserSettingController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/user-settings', [UserSettingController::class, 'update'])->middleware('auth:sanctum');
});

Route::apiResource('product', ProductController::class);
Route::get('products/search', [ProductController::class, 'search']);

Route::get('favorites', [FavoriteController::class, 'index'])->middleware(['auth:sanctum']);; // List favorites
Route::post('favorites', [FavoriteController::class, 'store'])->middleware(['auth:sanctum']);;// Add favorite
Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy'])->middleware(['auth:sanctum']); // Remove favorite


Route::apiResource("categories", CategoryController::class);

Route::apiResource('/testimonial', TestimonialController::class);
Route::post('/our-news', OurNewsController::class);

// Route::group(['middleware'=> 'auth:sanctum'],function(){
//     Route::apiResource('/testimonial', TestimonialController::class);
// });


Route::apiResource("reviews", ReviewController::class);
Route::get("instagram-stories", [InstagramStoriesController::class, "index"]);
Route::apiResource("cart", CartController::class);
