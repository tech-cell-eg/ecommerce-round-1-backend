<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })
// ->middleware('auth:admin')
// ->name('dashboard');


Route::get('/admin/products', function () {
    return 'Products';
})
    ->middleware('auth:admin')
    ->name('admin.product');


Route::get('/admin/category', function () {
    return 'category';
})
    ->middleware('auth:admin')
    ->name('admin.category');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin/products/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});




Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/admin/category/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('category.store');
    Route::patch('/admin/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/admin/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/subcategory', [SubCategoryController::class, 'index'])->name('subCategory.index');
    Route::get('/admin/subcategory/create', [SubCategoryController::class, 'create'])->name('subCategory.create');
    Route::get('/admin/subcategory/{subcategory}', [SubCategoryController::class, 'edit'])->name('subCategory.edit');
    Route::post('/admin/subcategory', [SubCategoryController::class, 'store'])->name('subCategory.store');
    Route::patch('/admin/subcategory/{category}', [SubCategoryController::class, 'update'])->name('subCategory.update');
    Route::delete('/admin/subcategory/{category}', [SubCategoryController::class, 'destroy'])->name('subCategory.destroy');
});


Route::resource('testimonials', TestimonialController::class)->middleware('auth:admin');
Route::resource('orders', OrderController::class)->middleware('auth:admin');
Route::resource('coupons', CouponController::class)->middleware('auth:admin');
Route::resource('blogs', BlogController::class)->middleware('auth:admin');


Route::middleware('auth:admin')->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});


Route::resource('users', UsersController::class)->middleware('auth:admin');


Route::resource('admins', AdminController::class)->middleware('auth:admin');

Route::middleware('auth:admin')->group(function () {

    Route::get('admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('admin/contacts/{id}/reply', [ContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::post('admin/contacts/{id}/send-reply', [ContactController::class, 'sendReply'])->name('admin.contacts.sendReply');
});


require __DIR__.'/auth.php';



