<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::pluck('category');
    
        if ($categories->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'error' => 'No categories found.',
            ], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'categories' => $categories,
        ], 200);
    }
    

    public function destroy($categoryName)
    {
        try {
            $deleted = Category::where('category', $categoryName)->delete();
    
            if ($deleted) {
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'success' => 'Category deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'error' => 'Category not found or failed to delete'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'error' => 'Failed to delete category',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255|unique:categories,category',
            ]);
    
            $category = new Category();
            $category->category = $request->input('category_name');
            $category->save();

            $category->makeHidden(['created_at', 'updated_at']);

            return response()->json([
                'status' => 'success',
                'code' => 201, 
                'success' => 'Category added successfully',
                'category' => $category,
            ], 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'error' => $e->errors(),
            ], 422);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'error' => 'Failed to add category.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    
}