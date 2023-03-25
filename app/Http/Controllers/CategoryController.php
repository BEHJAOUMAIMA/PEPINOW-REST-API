<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCategoriesRequest;
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
            "status" => true,
            "message" => "All Categories",
            "categories" => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'Category created Successfully !',
            'category'=>$category
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            "status" => true,
            "category" => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoriesRequest $request, Category $category)
    {
        $category->update($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'Category updated Successfully !',
            'category'=>$category,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        
    }
}
