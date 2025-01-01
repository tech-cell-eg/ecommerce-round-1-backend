<?php

namespace App\Http\Controllers\API\Product;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Product\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ApiResponse;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware(): array
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
        $model = Product::query();
        if ($request->has('category_id')) {
            $model->where('category_id', $request->get('category_id'));
        }
        if ($request->filled('sub_category_id')) {
            $categoryId = SubCategory::where('id', $request->get('sub_category_id'))->first()->category_id;
            $model->where('category_id', $categoryId);
        }
        if ($request->has('minPrice')) {
            $model->where('price', '>=', $request->get('minPrice'));
        }
        if ($request->has('maxPrice')) {
            $model->where('price', '<=', $request->get('maxPrice'));
        }
        return $this->success(200, 'Products retrieved successfully.', ProductResource::collection($model->with('category', 'reviews')->paginate(8)));
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
     *
     *
     *
     *       if($request->hasFile("image")) {
     * File::delete(public_path($request->image));
     * $image = $request->file("image");
     * $fileName = $image->store("/", "public");
     * $filePath = "uploads/".$fileName;
     * $product->image = $filePath;
     * }
     *
     * $product->name = $request->name;
     * $product->price = $request->price;
     * $product->short_description = $request->short_description;
     * $product->description = $request->description;
     * $product->quantity = $request->qty;
     * $product->sku = $request->sku;
     * $product->save();
     *
     * // insert colors
     * if($request->has("colors") && $request->filled("colors")) {
     *
     * foreach ($product->colors as $color) {
     * $color->delete();
     * }
     *
     * foreach ($request->colors as $color) {
     * ProductColor::create([
     * "name" => $color,
     * "product_id" => $product->id
     * ]);
     * }
     * }
     *
     * if($request->hasFile("images")) {
     *
     * foreach ($product->images as $image) {
     * File::delete(public_path($image->path));
     * }
     * $product->images()->delete();
     *
     * foreach ($request->file("images") as  $image) {
     * $fileName = $image->store("/", "public");
     * $filePath = "uploads/".$fileName;
     * ProductImage::create([
     * "path" => $filePath,
     * "product_id" => $product->id
     * ]);
     * }
     * }
     *
     *
     * notyf('Product Updated Successfully.');
     * return redirect()->back();
     */
    // This function just for testing images
    public function store(StoreProductRequest $request)
    {

        $validatedData = $request->validated();

        if ($request->hasFile('image')) {

            // $validatedData['image'] = $request->file('image');
            $validatedData['image'] = $request->file('image')->store('/uploads');
            Storage::disk("public")->putFile($request->image);
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
