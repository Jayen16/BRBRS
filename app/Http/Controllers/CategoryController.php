<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function displayCategory(){
        $categories = Category::pluck('category');
    
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function deleteCategory($category) {
        $deleted = Category::where('category', $category)->delete();
    
        if ($deleted) {
            return response()->json(['message' => 'Category deleted successfully']);
        } else {
            return response()->json(['message' => 'Failed to delete category'], 500);
        }
    }
    
    public function addCategory(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category', 
        ]);
    
        $category = new Category();
        $category->category = $request->input('category_name');
        $category->save();
    
        return response()->json(['message' => 'Category added successfully', 'category' => $category]);
    }
    
}
