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

    /**
     * @OA\Get(
     *     path="/reviews",
     *     tags={"review"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    function index() {
        $reviews = Review::all();
        return $this->success(200, "all reviews", $reviews);
    }

    /**
     * @OA\Get(
     *     path="/reviews/1",
     *     tags={"review"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    function show(Review $review) {
        return $this->success(200, "review found!", $review);
    }

    /**
     * @OA\Post(
     *     path="/reviews",
     *     tags={"review"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    function store(ReviewRequest $request) {
        Review::create($request->validated());
        return $this->success(200, "review created successfully!");
    }

    /**
     * @OA\Put(
     *     path="/reviews/1",
     *     tags={"review"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    function update(ReviewRequest $request, Review $review) {
        $review->update($request->validated());
        return $this->success(200, "review updated successfully!");
    }

    /**
     * @OA\Delete(
     *     path="/reviews/1",
     *     tags={"review"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    function destroy(Review $review) {
        $review->delete();
        return $this->success(200, "review deleted successfully!");
    }
}
