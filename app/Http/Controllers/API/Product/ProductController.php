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

class ProductController extends Controller 
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Product::query();

        $filters = new ProductFilter();

        $query = $filters->filter($query, $request->all());
        $products = $query->paginate(); // Paginate results

        return $this->success(200, 'Products retrieved successfully.', ProductResource::collection($products));

    }


    public function show(Product $product)
    {
        $product->load('relatedProducts', 'category.sub');
        return $this->success(200, 'Product returned successfully.', new ProductResource($product));


    }


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
