<?php

namespace App\Http\Controllers\API\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Review\ReviewRequest;
use App\Http\Requests\API\Review\UpdateReviewRequest;
use App\Models\Review;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReviewController extends Controller
{
    use ApiResponse;


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
    function index()
    {
        $reviews = Review::all();
        return $this->success(200, "all reviews", $reviews);
    }

    /**
     * @OA\Get(
     *     path="/reviews/{id}",
     *     tags={"review"},
     *     summary="Get review by id",
     *     description="Endpoint to Get review by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    function show(Review $review)
    {
        return $this->success(200, "review found!", $review);
    }

    /**
     * @OA\Post(
     *     path="/reviews",
     *     tags={"review"},
     *     security={{"bearerAuth": {}}},
     *     summary="Create a review for a product",
     *     description="Endpoint to create a review with product, user details, and review information",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
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
     *         ))
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     *     @OA\Response(
     *          response="401",
     *          description="Error: Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse-2")
     *      ),
     * )
     */
    function store(ReviewRequest $request)
    {
        $review = Review::create($request->validated());
        return $this->success(200, "review created successfully!", $review);
    }

    /**
     * @OA\Put(
     *     path="/reviews/{id}",
     *     tags={"review"},
     *     security={{"bearerAuth": {}}},
     *     summary="Update an existing review",
     *     description="Endpoint to update an existing review with product, user details, and review information",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
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
     *     @OA\Response(
     *          response="401",
     *          description="Error: Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse-2")
     *      ),
     * )
     */
    function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->validated());
        return $this->success(200, "review updated successfully!");
    }

    /**
     * @OA\Delete(
     *     path="/reviews/{id}",
     *     tags={"review"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete a review by id",
     *     description="Endpoint to delete a review by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     *     @OA\Response(
     *          response="401",
     *          description="Error: Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse-2")
     *      ),
     * )
     */
    function destroy(Review $review)
    {
        $review->delete();
        return $this->success(200, "review deleted successfully!");
    }
}
