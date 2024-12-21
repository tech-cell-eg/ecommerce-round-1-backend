<?php

namespace App\Http\Controllers\API\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Review\ReviewRequest;
use App\Models\Review;
use App\Traits\ApiResponse;

class ReviewController extends Controller
{
    use ApiResponse;

    function index() {
        $reviews = Review::all();
        return $this->success(200, "all reviews", $reviews);
    }

    function show(Review $review) {
        return $this->success(200, "review found!", $review);
    }

    function store(ReviewRequest $request) {
        Review::create($request->validated());
        return response(["message" => "review created successfully!"]);
        return $this->success(200, "review created successfully!");
    }

    function update(ReviewRequest $request, Review $review) {
        $review->update($request->validated());
        return $this->success(200, "review updated successfully!");
    }

    function destroy(Review $review) {
        $review->delete();
        return $this->success(200, "review deleted successfully!");
    }
}
