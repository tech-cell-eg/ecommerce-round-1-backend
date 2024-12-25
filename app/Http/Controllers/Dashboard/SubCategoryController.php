<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate();
        return view('admin.SubCategory.index', compact('subcategories')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        $categories=Category::all();
        return view('admin.SubCategory.create',compact('categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
            $validatedData = $request->validated();

            $subcategory = SubCategory::create($validatedData->all());
            return redirect()->route('subCategory.index')->with('success', 'Sub Category created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories=Category::all();
        return view('admin.SubCategory.edit', compact(['subCategory','categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validatedData = $request->validated();

            $subcategory = SubCategory::findOrFail($id);
            $subcategory->update($validatedData->all());
            return redirect()->route('subCategory.index')->with('success', 'Sub Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        return redirect()->route('subCategory.index')->with('success', 'Sub Category deleted successfully');
    }
}
