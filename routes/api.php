<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('product',ProductController::class);
Route::get('products/search', [ProductController::class, 'search']);
// Route::apiResource('favorites',FavoriteController::class);


Route::post('favorites', [FavoriteController::class, 'store']); // Add favorite
Route::get('favorites/{user_id}', [FavoriteController::class, 'index']); // List favorites
Route::delete('favorites/{user_id}/{product_id}', [FavoriteController::class, 'destroy']); // Remove favorite

