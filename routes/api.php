<?php

use App\Http\Controllers\API\Auth\UpdateUserController;
use App\Http\Controllers\API\Notification\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WishListController;
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
use App\Http\Controllers\API\InstagramStory\InstagramStoriesController;
use App\Http\Controllers\API\Testimonial\TestimonialController;
use App\Http\Controllers\API\UserSetting\UserSettingController;
use App\Http\Controllers\API\OurStory\OurStoryController;
use App\Http\Controllers\CouponController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// ***************************************************************
// *** social Login
// ***************************************************************
Route::get('/{provider}-login', [SocialLoginController::class, 'providerAuth']);
Route::get('/{provider}-callback', [SocialLoginController::class, 'providerCallback']);

// ***************************************************************
// *** login
// ***************************************************************
Route::post('/login', LoginController::class);

// ***************************************************************
// *** register
// ***************************************************************
Route::post('/register', RegisterController::class);

// ***************************************************************
// *** logout
// ***************************************************************
Route::post('/logout', LogoutController::class);

// ***************************************************************
// *** password
// ***************************************************************
Route::post('/reset-password', ResetPasswordController::class);
Route::post('/forgot-password', ForgotPasswordController::class);

// ***************************************************************
// *** addresses
// ***************************************************************
Route::apiResource('addresses', UserAddressController::class);

// ***************************************************************
// *** user
// ***************************************************************
Route::patch('/user', UpdateUserController::class);
Route::get('/user-settings', [UserSettingController::class, 'index']);
Route::patch('/user-settings', [UserSettingController::class, 'update']);

// ***************************************************************
// *** cards
// ***************************************************************
Route::get('/cards', [UserCardController::class, 'index']);
Route::post('/cards', [UserCardController::class, 'store']);
Route::delete('/cards/{userCard}', [UserCardController::class, 'destroy']);

// ***************************************************************
// *** orders
// ***************************************************************
Route::apiResource('orders', OrderController::class);


// ***************************************************************
// *** product
// ***************************************************************
Route::get('products/search', [ProductController::class, 'search']);
Route::apiResource('products', ProductController::class);

// ***************************************************************
// *** favorites
// ***************************************************************
Route::get('favorites', [FavoriteController::class, 'index']);
Route::post('favorites', [FavoriteController::class, 'store']);
Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy']);

// ***************************************************************
// *** categories
// ***************************************************************
Route::apiResource("categories", CategoryController::class);

// ***************************************************************
// *** testimonials
// ***************************************************************
Route::apiResource('/testimonials', TestimonialController::class);
Route::get('testimonials/{testimonial}/user', [TestimonialController::class, 'GetUserByTestimonial']);

// ***************************************************************
// *** our-news
// ***************************************************************
Route::post('/our-news', OurNewsController::class);

// ***************************************************************
// *** setting
// ***************************************************************
Route::apiResource('/setting', SettingController::class);

// ***************************************************************
// *** contact
// ***************************************************************
Route::apiResource('/contact', ContactController::class);

// ***************************************************************
// *** wish-list
// ***************************************************************
Route::apiResource('/wish-list', WishListController::class);

// ***************************************************************
// *** user blog
// ***************************************************************
Route::post('/blog/{blog}/comment', [UserBlogController::class, 'BlogComment']);
Route::put('blog/{blog}/comment', [UserBlogController::class, 'EditComment']);
Route::delete('/blog/{blog}/comment', [UserBlogController::class, 'DeleteComment']);
Route::get('/blog/{blog}/like', [UserBlogController::class, 'BlogLike']);
Route::post('blog/{blog}/bookmark', [UserBlogController::class, 'BookmarkBlog']);
Route::post('/author/{authorId}/follow', [UserBlogController::class, 'FollowAuthor']);

// ***************************************************************
// *** admin blog
// ***************************************************************
Route::get('blog/comments', [AdminBlogController::class, 'ModerateComments']);
Route::get('/blog/featured-blogs', [AdminBlogController::class, 'ShowFeaturedBlogs']);
Route::get('blog/draft', [AdminBlogController::class, 'ShowDraftBlogs']);
Route::get('/blog/analytics', [AdminBlogController::class, 'ShowBlogsAnalytics']);
Route::put('/blog/{blog}', [AdminBlogController::class, 'update']);
Route::delete('blog/{blog}', [AdminBlogController::class, 'delete']);
Route::post('/blog', [AdminBlogController::class, 'store']);
Route::get('/blog', [AdminBlogController::class, 'index']);

// ***************************************************************
// *** guest blog
// ***************************************************************
Route::get('/blog/search', [GuestBlogController::class, 'search']);
Route::get('/blog/recents', [GuestBlogController::class, 'show_recent_blogs']);
Route::apiResource('/blog', GuestBlogController::class);


// ***************************************************************
// *** reviews
// ***************************************************************
Route::apiResource("reviews", ReviewController::class);


// ***************************************************************
// *** our-stories
// ***************************************************************
Route::get("our-stories", [OurStoryController::class, "index"]);
Route::post("our-stories", [OurStoryController::class, "store"]);
Route::get("our-stories/{ourStory}", [OurStoryController::class, "show"]);


// ***************************************************************
// *** cart
// ***************************************************************
Route::delete('/cart/clear', [CartController::class, 'clearAllCart']);
Route::apiResource("cart", CartController::class);


// ***************************************************************
// *** notifications
// ***************************************************************
Route::get("notifications", [NotificationController::class, "index"]);
Route::get("notifications/{id}", [NotificationController::class, "show"]);
Route::delete("notifications/{id}", [NotificationController::class, "destroy"]);


// ***************************************************************
// *** coupon
// ***************************************************************
Route::post('/apply-coupon', [CouponController::class, 'applyCoupon']);


// ***************************************************************
// *** instagram-stories
// ***************************************************************
Route::get("instagram-stories", [InstagramStoriesController::class, "index"]);
