<?php

namespace App\Http\Controllers\Product;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        $filters = new ProductFilter();

        $query = $filters->filter($query, $request->all());
        // Paginate results
        $products = $query->paginate();

        return ProductResource::collection($products);
    }


    public function show(Product $product)
    {
        return new ProductResource($product);
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
