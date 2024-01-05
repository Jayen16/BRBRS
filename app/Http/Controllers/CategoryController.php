<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(){
        $categories = Category::pluck('category');
    
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function destroy($categoryName)
    {
        try {
            $deleted = Category::where('category', $categoryName)->delete();
    
            if ($deleted) {
                return response()->json(['message' => 'Category deleted successfully']);
            } else {
                return response()->json(['error' => 'Category not found or failed to delete'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete category', 'message' => $e->getMessage()], 500);
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
    
            return response()->json(['message' => 'Category added successfully', 'category' => $category]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add category.', 'message' => $e->getMessage()], 500);
        }
    }
    
    
}
