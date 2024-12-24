<?php

namespace App\Http\Controllers\API\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Review\ReviewRequest;
use App\Models\Review;
use App\Notifications\ReviewNotification;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReviewController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', "show"]),
        ];
    }

    function index() {
        $reviews = Review::all();
        return $this->success(200, "all reviews", $reviews);
    }

    function show(Review $review) {
        return $this->success(200, "review found!", $review);
    }

    function store(ReviewRequest $request) {
        Review::create($request->validated());
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
