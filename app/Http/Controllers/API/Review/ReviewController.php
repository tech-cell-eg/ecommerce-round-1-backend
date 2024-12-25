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
     *     summary="Get all reviews",
     *     description="Endpoint to Get all reviews",
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
     *     summary="Get review by id",
     *     description="Endpoint to Get review by id",
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
     *     summary="Create a review for a product",
     *     description="Endpoint to create a review with product, user details, and review information",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"msg", "stars", "product_id", "user_id", "user_role"},
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="Review message text",
     *                 example="This product is excellent!"
     *             ),
     *             @OA\Property(
     *                 property="stars",
     *                 type="integer",
     *                 description="Rating stars from 1 to 5",
     *                 example=5
     *             ),
     *             @OA\Property(
     *                 property="product_id",
     *                 type="integer",
     *                 description="ID of the product being reviewed",
     *                 example=101
     *             ),
     *             @OA\Property(
     *                 property="user_id",
     *                 type="integer",
     *                 description="ID of the user creating the review",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="user_role",
     *                 type="integer",
     *                 description="Role ID of the user (e.g., 1 for customer, 2 for admin)",
     *                 example=1
     *             )
     *         )
     *     ),
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
     *     summary="Update an existing review",
     *     description="Endpoint to update an existing review with product, user details, and review information",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"msg", "stars", "product_id", "user_id", "user_role"},
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="Updated review message text",
     *                 example="This product is awesome now!"
     *             ),
     *             @OA\Property(
     *                 property="stars",
     *                 type="integer",
     *                 description="Updated rating stars from 1 to 5",
     *                 example=4
     *             ),
     *             @OA\Property(
     *                 property="product_id",
     *                 type="integer",
     *                 description="ID of the product being reviewed",
     *                 example=101
     *             ),
     *             @OA\Property(
     *                 property="user_id",
     *                 type="integer",
     *                 description="ID of the user updating the review",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="user_role",
     *                 type="integer",
     *                 description="Role ID of the user (e.g., 1 for customer, 2 for admin)",
     *                 example=1
     *             )
     *         )
     *     ),
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
     *     summary="Delete a review by id",
     *     description="Endpoint to delete a review by id",
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
