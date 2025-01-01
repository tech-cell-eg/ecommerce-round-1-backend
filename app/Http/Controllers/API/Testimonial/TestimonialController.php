<?php

namespace App\Http\Controllers\API\Testimonial;

use App\Models\User;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TestimonialResource;
use App\Http\Requests\API\Testimonial\TestimonialStoreRequest;
use App\Http\Requests\API\Testimonial\TestimonialUpdateRequest;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TestimonialController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['index', "show"]),
        ];
    }

    /**
     * @OA\Get(
     *     path="/testimonial",
     *     tags={"testimonial"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all testimonials",
     *     description="Endpoint to Get all testimonials",
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
    public function index()
    {
        $testimonials = Testimonial::with('user')->get();
        return $this->success(200, "Testimonials retrived successfully!", TestimonialResource::collection($testimonials));

    }

    /**
     * @OA\Post(
     *     path="/testimonial",
     *     tags={"testimonial"},
     *     security={{"bearerAuth": {}}},
     *     summary="Create a testimonial for a product",
     *     description="Endpoint to create a testimonial with product, text, image, and video",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"product_id", "text"},
     *                 @OA\Property(
     *                     property="product_id",
     *                     type="integer",
     *                     description="ID of the product for the testimonial",
     *                     example=101
     *                 ),
     *                 @OA\Property(
     *                     property="text",
     *                     type="string",
     *                     description="Testimonial text",
     *                     example="This product changed my life!"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string",
     *                     format="binary",
     *                     description="Testimonial image file (optional)"
     *                 ),
     *                 @OA\Property(
     *                     property="video",
     *                     type="string",
     *                     format="binary",
     *                     description="Testimonial video file (optional)"
     *                 )
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
    public function store(TestimonialStoreRequest $request)
    {
        // Find the user (replace with dynamic user if needed)
        $user = User::find(1);

        // Create the testimonial using validated data
        $testimonial = $user->testimonials()->create($request->validated());

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials/images', 'public');
            $testimonial->image = url('storage/' . $path); // Full URL
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('testimonials/videos', 'public');
            $testimonial->video = url('storage/' . $path); // Full URL
        }

        // Save the updated testimonial
        $testimonial->save();

        // Return the response
        return $this->success(200, "Testimonial created successfully!", $testimonial);

    }


    /**
     * @OA\Get(
     *     path="/testimonial/{id}",
     *     tags={"testimonial"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get a testimonial by id",
     *     description="Endpoint to Get a testimonial by id",
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
    public function show(Testimonial $testimonial)
    {
        $testimonial->user;
        return $this->success(200, "Testimonial returned successfully!", $testimonial);
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials/images', 'public');
            $imagePath = asset('storage/' . $path);
            $testimonial->image = $imagePath;
        }
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('testimonials/videos');
            $videoPath = asset('storage/' . $path);
            $testimonial->video = $videoPath;
        }

        $testimonial->update($request->validated());
        $testimonial->save();
        return $this->success(200, "Testimonial updated successfully!", $testimonial);

    }

    /**
     * @OA\Delete(
     *     path="/testimonial/{id}",
     *     tags={"testimonial"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete testimonial by id",
     *     description="Endpoint to Delete testimonial by id",
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
    public function destroy(Testimonial $testimonial)
    {
        if (!$testimonial->exists())
            return $this->failed(404, "Testimonial Not Found!");

        $testimonial->delete();
        return $this->success(200, "Testimonial deleted successfully.");
    }

    public function GetUserByTestimonial(Testimonial $testimonial)
    {
        // return response()->json($testimonial);
        $user = User::where('id', $testimonial->user_id)->get();
        return $this->success(200, "User data returned successfully.", $user);

    }
}
