<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Category\CategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *     path="/categories",
     *     tags={"Category"},
     *     summary="Get all categories",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function index()
    {
        $categories = Category::all(); // Get all categories
        return $this->success(200, "all categories", $categories);
    }

    /**
     * @OA\Post(
     *     path="/categories",
     *     tags={"Category"},
     *     security={{"bearerAuth": {}}},
     *     summary="Create a new category",
     *     description="Endpoint to create a new category",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *             required={"name"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the category",
     *                 example="Electronics"
     *             )
     *         ))
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            "name" => $request->name
        ]);
        return $this->success(200, "category created successfully!");
    }


    /**
     * @OA\Get(
     *     path="/categories/{id}",
     *     tags={"Category"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get category by id",
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
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        // extract Sub-category names from sub prop 
        $data = $category->sub->pluck("name")->toArray();
        $category["sub-category"] = $data;

        // hide sub prop
        $category->makeHidden(["sub"]);

        return $this->success(200, "category found!", $category);
    }

    /**
     * @OA\Put(
     *     path="/categories/{id}",
     *     tags={"Category"},
     *     security={{"bearerAuth": {}}},
     *     summary="Update a category by id",
     *     description="Endpoint to update a category",
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
     *             required={"name"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the category",
     *                 example="clothes"
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
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->success(200, "category updated successfully!");
    }

    /**
     * @OA\Delete(
     *     path="/categories/{id}",
     *     tags={"Category"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete a category by id",
     *     description="Endpoint to delete a category",
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
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success(200, "category deleted successfully!");
    }
}
