<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RolePermissionController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.admin-login');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
});


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index')->middleware('permission:product-list');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('permission:product-create');
    Route::get('/admin/products/show/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('permission:product-list');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store')->middleware('permission:product-create');
    Route::get('/admin/products/{product}', [ProductController::class, 'edit'])->name('products.edit')->middleware('permission:product-edit');
    Route::patch('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('permission:product-edit');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('permission:product-delete');
});



Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('category.index')->middleware('permission:category-list');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('permission:category-create');
    Route::get('/admin/category/{category}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('permission:category-edit');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('category.store')->middleware('permission:category-create');
    Route::patch('/admin/category/{category}', [CategoryController::class, 'update'])->name('category.update')->middleware('permission:category-edit');
    Route::delete('/admin/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('permission:category-delete');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/subcategory', [SubCategoryController::class, 'index'])->name('subCategory.index')->middleware('permission:category-list');
    Route::get('/admin/subcategory/create', [SubCategoryController::class, 'create'])->name('subCategory.create')->middleware('permission:category-create');
    Route::get('/admin/subcategory/{subcategory}', [SubCategoryController::class, 'edit'])->name('subCategory.edit')->middleware('permission:category-edit');
    Route::post('/admin/subcategory', [SubCategoryController::class, 'store'])->name('subCategory.store')->middleware('permission:category-create');
    Route::patch('/admin/subcategory/{category}', [SubCategoryController::class, 'update'])->name('subCategory.update')->middleware('permission:category-edit');
    Route::delete('/admin/subcategory/{category}', [SubCategoryController::class, 'destroy'])->name('subCategory.destroy')->middleware('permission:category-delete');
});



Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index')->middleware('permission:testimonials-list');
    Route::get('/admin/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create')->middleware('permission:testimonials-create');
    Route::get('/admin/testimonials/{testimonial}', [TestimonialController::class, 'edit'])->name('testimonials.edit')->middleware('permission:testimonials-edit');
    Route::post('/admin/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store')->middleware('permission:testimonials-create');
    Route::patch('/admin/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update')->middleware('permission:testimonials-edit');
    Route::delete('/admin/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy')->middleware('permission:testimonials-delete');
});





Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/coupons', [CouponController::class, 'index'])->name('coupons.index')->middleware('permission:coupons-list');
    Route::get('/admin/coupons/create', [CouponController::class, 'create'])->name('coupons.create')->middleware('permission:coupons-create');
    Route::get('/admin/coupons/{coupon}', [CouponController::class, 'edit'])->name('coupons.edit')->middleware('permission:coupons-edit');
    Route::post('/admin/coupons', [CouponController::class, 'store'])->name('coupons.store')->middleware('permission:coupons-create');
    Route::patch('/admin/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update')->middleware('permission:coupons-edit');
    Route::delete('/admin/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy')->middleware('permission:coupons-delete');
});



Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('permission:order-list');
    Route::get('/admin/orders/{order}/show', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/admin/orders/{order}', [OrderController::class, 'edit'])->name('orders.edit')->middleware('permission:order-edit');
    Route::patch('/admin/orders/{order}', [OrderController::class, 'update'])->name('orders.update')->middleware('permission:order-edit');
    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('permission:order-delete');
});





Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/blogs', [BlogController::class, 'index'])->name('blogs.index')->middleware('permission:blog-list');
    Route::get('/admin/blogs/show/{blog}', [BlogController::class, 'show'])->name('blogs.show')->middleware('permission:blog-list');
    Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('blogs.create')->middleware('permission:blog-create');
    Route::get('/admin/blogs/{blog}', [BlogController::class, 'edit'])->name('blogs.edit')->middleware('permission:blog-edit');
    Route::post('/admin/blogs', [BlogController::class, 'store'])->name('blogs.store')->middleware('permission:blog-create');
    Route::patch('/admin/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update')->middleware('permission:blog-edit');
    Route::delete('/admin/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy')->middleware('permission:blog-delete');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/users', [UsersController::class, 'index'])->name('users.index')->middleware('permission:user-list');
    Route::get('/admin/users/create', [UsersController::class, 'create'])->name('users.create')->middleware('permission:setting-create');
    Route::get('/admin/users/{user}', [UsersController::class, 'edit'])->name('users.edit')->middleware('permission:user-edit');
    Route::post('/admin/users', [UsersController::class, 'store'])->name('users.store')->middleware('permission:setting-create');
    Route::patch('/admin/users/{user}', [UsersController::class, 'update'])->name('users.update')->middleware('permission:user-edit');
    Route::delete('/admin/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('permission:user-delete');
});




Route::middleware('auth:admin')->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index')->middleware('permission:setting-list');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update')->middleware('permission:setting-edit');
});




Route::resource('admins', AdminController::class)->middleware('auth:admin');

Route::middleware('auth:admin')->group(function () {

    Route::get('admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index')->middleware('permission:contact-list');
    Route::get('admin/contacts/{id}/reply', [ContactController::class, 'reply'])->name('admin.contacts.reply')->middleware('permission:contact-create');
    Route::post('admin/contacts/{id}/send-reply', [ContactController::class, 'sendReply'])->name('admin.contacts.sendReply')->middleware('permission:contact-create');
});



Route::middleware(['auth:admin','role:super-admin'])->group(function () {
    Route::get('admin/roles-permissions', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::get('admin/roles-permissions/permissions', [RolePermissionController::class, 'permissions'])->name('roles.permissions');
    Route::get('admin/roles', [RolePermissionController::class, 'create'])->name('roles.create');
    Route::post('admin/roles', [RolePermissionController::class, 'store'])->name('roles.store');
});

Route::middleware(['auth:admin','role:super-admin'])->group(function () {
    Route::get('admin/permissions', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('admin/permissions', [PermissionController::class, 'store'])->name('permissions.store');
});
require __DIR__ . '/auth.php';
