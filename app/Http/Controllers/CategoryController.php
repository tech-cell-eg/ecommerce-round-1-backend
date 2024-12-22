<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $categories = Category::all(); // Get all categories
        return $this->success(200, "all categories", $categories);
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            "name" => $request->name
        ]);
        return $this->success(200, "category created successfully!");
    }


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

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->success(200, "category updated successfully!");
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success(200, "category deleted successfully!");
    }
}
