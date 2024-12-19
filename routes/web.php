<?php

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


// Route::middleware('auth:admin')->group(function () {
//     Route::get('admin/products', [AdminUserController::class, 'index'])
//     ->name('admin.users');
// });

require __DIR__.'/auth.php';
