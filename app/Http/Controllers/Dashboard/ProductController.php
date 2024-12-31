<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate();
        return view('admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.Product.create',compact('categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated(); 

        // Handle the image upload
        $imagePath = $this->uploadImage($request); // Call uploadImage method
    
        if ($imagePath) {
            $validatedData['image'] = $imagePath; // Add the image path to the validated data
        }
    
        // Create the product using validated and modified data
        $product = Product::create($validatedData);
    
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    
        return view('admin.Product.show', compact('product'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories=Category::all();
        $product->load('category.sub');
        return view('admin.Product.edit', compact(['product','categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
    {

        $validatedData = $request->validated(); // Get all validated data
        // // Find the category by ID
        $product = Product::findOrFail($id);
        if(!$product){
            abort(404);
        }
        $oldImage=$product->image;

        $data=$request->except('image'); // except image to can merge it 
        $data['image']=$this->uploadImage($request);
        
        // Update the category with the request data
        $product->update($data);
        
        if($oldImage && isset($data['image'])){
            Storage::disk('public')->delete($oldImage);     // delete Old Image Form the Public Disk
        }
        return redirect()->route('products.index')->with('success','Product Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
        
    }
}
