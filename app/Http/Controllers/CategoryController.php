<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'data' => $categories,
            'message' => "all categories"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            "name" => $request->name
        ]);
        return response(["message"=> "category has been added successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        // extract Sub-category names from sub prop 
        $data = $category->sub->pluck("name")->toArray();
        $category["sub-category"] = $data;

        // hide sub prop
        $category->makeHidden(["sub"]);

        return response($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
    $category->update($request->validated());
    return response(["message" => "Category has been updated successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $category = Category::findOrFail($id);
    //     $category->delete();
    //     return response(["message"=> "category has been deleted successfully!"]);
    // }
    public function destroy(Category $category)
    {
    $category->delete();
    return response(["message"=> "category has been deleted successfully!"]);
    }
}
