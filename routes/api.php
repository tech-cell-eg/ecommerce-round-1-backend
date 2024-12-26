<?php

use App\Http\Controllers\API\Auth\UpdateUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\API\Cart\CartController;
use App\Http\Controllers\Blog\UserBlogController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\Blog\AdminBlogController;
use App\Http\Controllers\Blog\GuestBlogController;
use App\Http\Middleware\API\CatchErrorsMiddleware;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Order\OrderController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Review\ReviewController;
use App\Http\Controllers\API\OurNews\OurNewsController;
use App\Http\Controllers\API\Product\ProductController;
use App\Http\Controllers\API\Auth\SocialLoginController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Favorite\FavoriteController;
use App\Http\Controllers\API\UserCard\UserCardController;
use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Address\UserAddressController;
use App\Http\Controllers\API\Testimonial\TestimonialController;
use App\Http\Controllers\API\UserSetting\UserSettingController;
use App\Http\Controllers\API\InstagramStory\OurStoryController;
use App\Http\Controllers\CouponController;

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
    Route::post('/reset-password', ResetPasswordController::class)->middleware('throttle:5,1');
    Route::post('/forgot-password', ForgotPasswordController::class)->middleware('throttle:5,1');
    Route::apiResource('addresses', UserAddressController::class)->middleware('auth:sanctum');
    Route::patch('/user', UpdateUserController::class)->middleware('auth:sanctum');
    Route::get('/cards', [UserCardController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/cards/store', [UserCardController::class, 'store'])->middleware('auth:sanctum');
    Route::delete('/cards/{userCard}', [UserCardController::class, 'destroy'])->middleware('auth:sanctum');
    Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');
    Route::get('/user-settings', [UserSettingController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/user-settings', [UserSettingController::class, 'update'])->middleware('auth:sanctum');
});

Route::apiResource('product', ProductController::class);
Route::get('products/search', [ProductController::class, 'search']);
Route::get('favorites', [FavoriteController::class, 'index'])->middleware(['auth:sanctum']);
Route::post('favorites', [FavoriteController::class, 'store'])->middleware(['auth:sanctum']);
Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy'])->middleware(['auth:sanctum']);
Route::apiResource("categories", CategoryController::class)->middleware(['auth:sanctum']);
Route::apiResource('/testimonial', TestimonialController::class);
Route::get('testimonial/{testimonial}/user', [TestimonialController::class, 'GetUserByTestimonial']);
Route::post('/our-news', OurNewsController::class);
Route::apiResource('/setting', SettingController::class)->middleware(['auth:sanctum']);
Route::apiResource('/contact', ContactController::class);
Route::apiResource('/wish-list', WishListController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/blog/{blog}/comment', [UserBlogController::class, 'BlogComment'])->name('Blog.comment.create');
    Route::put('blog/{blog}/comment', [UserBlogController::class, 'EditComment'])->name('Blog.comment.edit');
    Route::delete('/blog/{blog}/comment', [UserBlogController::class, 'DeleteComment'])->name('Blog.comment.delete');
    Route::get('/blog/{blog}/like', [UserBlogController::class, 'BlogLike'])->name('Blog.like');
    Route::post('blog/{blog}/bookmark', [UserBlogController::class, 'BookmarkBlog'])->name('Blog.bookmark');
    Route::post('/author/{authorId}/follow', [UserBlogController::class, 'FollowAuthor'])->name('Blog.followers');
});

Route::group(['middleware' => ['auth:sanctum', AdminMiddleware::class]], function () {
    Route::get('blog/comments', [AdminBlogController::class, 'ModerateComments']);
    Route::get('/blog/featured-blogs', [AdminBlogController::class, 'ShowFeaturedBlogs']);
    Route::get('blog/draft', [AdminBlogController::class, 'ShowDraftBlogs']);
    Route::get('/blog/analytics', [AdminBlogController::class, 'ShowBlogsAnalytics']);
    Route::put('/blog/{blog}', [AdminBlogController::class, 'update']);
    Route::delete('blog/{blog}', [AdminBlogController::class, 'delete']);
    Route::post('/blog', [AdminBlogController::class, 'store']);
    Route::get('/blog', [AdminBlogController::class, 'index']);
});

Route::get('/blog/search', [GuestBlogController::class, 'search']);
Route::get('/blog/recents', [GuestBlogController::class, 'show_recent_blogs']);
Route::apiResource('/blog', GuestBlogController::class);

Route::get('/fc', fn()=>\App\Models\OurStory::factory()->create());
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/testimonial', TestimonialController::class);
});

Route::apiResource("reviews", ReviewController::class);
Route::get("our-stories", [OurStoryController::class, "index"]);
Route::get("our-stories/{ourStory}", [OurStoryController::class, "show"]);
Route::delete('/cart/clear', [CartController::class, 'clearAllCart'])->middleware('auth:sanctum')->name('cart.clear');
Route::apiResource("cart", CartController::class)->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get("notifications", [NotificationController::class, "index"]);
    Route::get("notifications/{id}", [NotificationController::class, "show"]);
    Route::delete("notifications/{id}", [NotificationController::class, "destroy"]);
});

Route::post('/apply-coupon', [CouponController::class, 'applyCoupon']);
