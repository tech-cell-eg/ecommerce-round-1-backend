<?php

namespace App\Http\Controllers\API\Product;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Product\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', only: ['store']),
        ];
    }

    /**
     * @OA\Get(
     *     path="/product",
     *     tags={"product"},
     *     summary="Get all products",
     *     @OA\Response(
     *      response="200", 
     *      description="ok",
     *      @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      )
     * )
     */
    
    public function index(Request $request)
    {
        $query = Product::query();

        $filters = new ProductFilter();

        $query = $filters->filter($query, $request->all());
        $products = $query->paginate(); // Paginate results

        return $this->success(200, 'Products retrieved successfully.', ProductResource::collection($products));

    }


    /**
     * @OA\Get(
     *     path="/product/{id}",
     *     tags={"product"},
     *     summary="Get product by id",
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
    public function show(Product $product)
    {
        $product->load('relatedProducts', 'category.sub');
        return $this->success(200, 'Product returned successfully.', new ProductResource($product));
    }

    /**
     * @OA\Post(
     *     path="/product",
     *     tags={"product"},
     *     security={{"bearerAuth": {}}},
     *     summary="Create product",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "price", "description", "category_id", "image"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="The name of the product",
     *                     example="Sample Product"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="number",
     *                     format="float",
     *                     description="The price of the product",
     *                     example=99.99
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="The description of the product",
     *                     example="This is a sample product description."
     *                 ),
     *                 @OA\Property(
     *                     property="compare_price",
     *                     type="number",
     *                     format="float",
     *                     description="The compare price (e.g., original price)",
     *                     example=129.99
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string",
     *                     format="binary",
     *                     description="Product image file"
     *                 ),
     *                 @OA\Property(
     *                     property="rating",
     *                     type="number",
     *                     format="float",
     *                     description="Product rating",
     *                     example=4.5
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="integer",
     *                     description="The ID of the product category",
     *                     example=1
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
    // This function just for testing images
    public function store(StoreProductRequest $request)
    {

        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('uploads', 'public');
        }
        // Create the product using validated and modified data
        $product = Product::create($validatedData);
        return $this->success(200, 'Product created successfully.', new ProductResource($product));

    }


    /**
     * @OA\Get(
     *     path="/products/search/query=n",
     *     tags={"product"},
     *     summary="Search in products list",
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $query = $request->input('query');

        // Search products by name or keywords
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
        return $this->success(200, 'Product search returned successfully.', ProductResource::collection($products));

    }


}
