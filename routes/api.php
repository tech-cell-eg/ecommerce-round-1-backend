<?php
use App\Http\Controllers\Blog\AdminBlogController;
use App\Http\Controllers\Blog\GuestBlogController;
use App\Http\Controllers\Blog\UserBlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OurNewsController;
use App\Http\Controllers\WishListController;
use App\Http\Middleware\AdminMiddleware;
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
use App\Http\Controllers\SettingController;
use App\Http\Controllers\API\Auth\SocialLoginController;

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
});

Route::apiResource('product', ProductController::class);
Route::get('products/search', [ProductController::class, 'search']);

Route::post('favorites', [FavoriteController::class, 'store'])->middleware(['auth:sanctum']); // Add favorite
Route::get('favorites', [FavoriteController::class, 'index'])->middleware(['auth:sanctum']);; // List favorites
Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy'])->middleware(['auth:sanctum']); // Remove favorite


Route::apiResource("categories", CategoryController::class);

Route::apiResource('/testimonial', TestimonialController::class);
Route::get('testimonial/{testimonial}/user',[TestimonialController::class, 'GetUserByTestimonial']);
Route::post('/our-news', OurNewsController::class);

Route::apiResource('/setting', SettingController::class);

Route::apiResource('/contact', ContactController::class);

Route::apiResource('/wish-list', WishListController::class);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/blog/{blog}/comment', [UserBlogController::class, 'BlogComment'])->name('Blog.comment.create');
    Route::put('blog/{blog}/comment',  [UserBlogController::class, 'EditComment'])->name('Blog.comment.edit');
    Route::delete('/blog/{blog}/comment', [UserBlogController::class, 'DeleteComment'])->name('Blog.comment.delete');
    Route::get('/blog/{blog}/like', [UserBlogController::class, 'BlogLike'])->name('Blog.like');
    Route::post('blog/{blog}/bookmark', [UserBlogController::class, 'BookmarkBlog'])->name('Blog.bookmark');
    Route::post('/author/{authorId}/follow', [UserBlogController::class, 'FollowAuthor'])->name('Blog.followers');
});

Route::group(['middleware' => ['auth:sanctum', AdminMiddleware::class]], function(){
    Route::get('blog/comments',[AdminBlogController::class, 'ModerateComments']);
    Route::get('/blog/featured-blogs',[AdminBlogController::class, 'ShowFeaturedBlogs']);
    Route::get('blog/draft', [AdminBlogController::class,'ShowDraftBlogs']);
    Route::get('/blog/analytics',[AdminBlogController::class, 'ShowBlogsAnalytics']);
    Route::put('/blog/{blog}', [AdminBlogController::class, 'update']);
    Route::delete('blog/{blog}', [AdminBlogController::class, 'delete']);
    Route::post('/blog',[AdminBlogController::class, 'store']);
    Route::get('/blog',[AdminBlogController::class, 'index']);
});

Route::get('/blog/search', [GuestBlogController::class, 'search']);
Route::get('/blog/recents', [GuestBlogController::class, 'show_recent_blogs']);
Route::apiResource('/blog', GuestBlogController::class);


// Route::group(['middleware'=> 'auth:sanctum'],function(){
//     Route::apiResource('/testimonial', TestimonialController::class);
// });



