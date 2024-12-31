<?php

namespace App\Http\Controllers\API\SubCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
class SubCategoryController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate();
        return $this->success(200, "all sub categories", $subcategories);
    }

    public function store(SubCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $subcategory = SubCategory::create($validatedData->all());
        return $this->success(200, "sub category created successfully!");
    }

    public function show(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        return $this->success(200, "sub category found!", $subcategory);
    }

    public function update(SubCategoryRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($validatedData->all());
        return $this->success(200, "sub category updated successfully!");
    }

    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        return $this->success(200, "sub category deleted successfully!");
    }
}
