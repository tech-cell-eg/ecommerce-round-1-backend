<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        //     // Filter by category
        // if ($request->has('category')) {
        //     $query->filterByCategory($request->input('category'));
        // }

        // Filter by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->filterByPrice($request->input('min_price'), $request->input('max_price'));
        }

        // Sort products
        if ($request->has('sort_by')) {
            $sortDirection = $request->input('sort_direction', 'asc'); // Default sort direction
            $query->sortBy($request->input('sort_by'), $sortDirection);
        }

        // Paginate results
        $products = $query->paginate();

        return ProductResource::collection($products);
    }


    public function show(Product $product)
    {

        // Eager load the related products
        $product->load('relatedProducts');

        // Return the product as a resource
        return new ProductResource($product);
    }

    // This function just for testing images
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        // Store the image and get its storage path
        $validatedData['image'] = $request->file('image')->store('uploads', 'public');

        // Create the product with the validated data
        $product = Product::create($validatedData);

        // Return the newly created product as a resource
        return new ProductResource($product);
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

        return response()->json(ProductResource::collection($products));
    }
}
