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
     *     path="/product/1",
     *     tags={"product"},
     *     summary="Get product by id",
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
     *     summary="Create product",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name", "price", "category_id"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the product"
     *             ),
     *             @OA\Property(
     *                 property="price",
     *                 type="number",
     *                 format="float",
     *                 description="Price of the product"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 nullable=true,
     *                 description="Description of the product"
     *             ),
     *             @OA\Property(
     *                 property="compare_price",
     *                 type="number",
     *                 format="float",
     *                 nullable=true,
     *                 description="Comparison price of the product"
     *             ),
     *             @OA\Property(
     *                 property="image",
     *                 type="string",
     *                 format="binary",
     *                 nullable=true,
     *                 description="Image of the product"
     *             ),
     *             @OA\Property(
     *                 property="rating",
     *                 type="number",
     *                 format="float",
     *                 nullable=true,
     *                 description="Rating of the product"
     *             ),
     *             @OA\Property(
     *                 property="category_id",
     *                 type="integer",
     *                 description="ID of the category to which the product belongs"
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
