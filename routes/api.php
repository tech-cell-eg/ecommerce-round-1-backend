<?php

use App\Http\Controllers\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/login',action: [TestimonialController::class,'login']);
Route::apiResource('/testimonial', TestimonialController::class);

// Route::group(['middleware'=> 'auth:sanctum'],function(){
//     Route::apiResource('/testimonial', TestimonialController::class);
// });


