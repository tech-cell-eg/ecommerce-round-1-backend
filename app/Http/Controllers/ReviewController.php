<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function index() {
        $reviews = Review::all();
        return response([
            "data" => $reviews,
            "message" => "all reviews"
        ]);
    }

    function show(Review $review) {
        return response($review);
    }

    function store(ReviewRequest $request) {
        Review::create($request->validated());
        return response(["message" => "review created successfully!"]);
    }

    function update(ReviewRequest $request, Review $review) {
        $review->update($request->validated());
        return response(["message" => "review updated successfully!"]);
    }

    function destroy(Review $review) {
        $review->delete();
        return response(["message" => "review deleted successfully!"]);
    }
}
