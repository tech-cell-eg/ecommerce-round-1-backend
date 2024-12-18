<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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
