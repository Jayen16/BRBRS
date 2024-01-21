<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BooksController extends Controller
{


    public function displayBooks()
    {
      
        return view('listbook');
   
    }



    public function index(Request $request , $category)
    {

        
        $category = $request->input('category');
        $limit = $request->input('limit', 1);
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $sortColumn = $request->input('sortColumn', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        
        $query = Book::query();

        
        if ($category) {
            $query->where('category', $category);
        }


    
        if ($search) {
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%');
            });
        }
    

        $result = $query->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $result->items(),
            'links' => $result->links()->toHtml(),
        ]);

    
    }
    
    public function showCategory(Request $request, $category)
    {
        $query = Book::query();
    
        if ($category !== null && $category != 'All Categories') {
            $query->where('category', $category);
        }
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                          ->orWhere('status', 'like', '%' . $search . '%')
                          ->orWhere('author', 'like', '%' . $search . '%');
            });
        }
    
        $sortColumn = $request->input('sortColumn', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');
        $query->orderBy($sortColumn, $sortOrder);
    
        $limit = $request->input('limit', 10);
        $result = $query->paginate($limit);
    
        if ($result->isEmpty()) {
            return response()->json(['message' => 'No books found in this category.']);
        }
    
        return response()->json([
            'data' => $result->items(),
            'links' => $result->links()->toHtml(),
        ]);
    }
    


   


        public function store(Request $request)
        {
            if (!$request->isMethod('post')) {
                return response()->json(['error' => 'Method Not Allowed'], 405);
            }
        
            try {
                $validatedData = $request->validate([
                    'title' => 'required|string',
                    'author' => 'required|string',
                    'location_rack' => 'required|string',
                    'status' => 'required|string', 
                    'isbn' => 'nullable|string', 
                    'category' => 'required|string',
                    'condition' => 'required|string',
                    'book_image' => 'nullable|image|mimes:jpeg,png,jpg',
                    'edition' => 'nullable|string',
                    'publisher' => 'nullable|string',
                    'copyright_year' => 'nullable|numeric',
                    'accession_number' => 'nullable|string',
                    'description' => 'nullable|string',
                ]);
        
                if ($request->hasFile('book_image')) {
                    $uploadedImage = $request->file('book_image');
                    $storagePath = 'books';
                    $title = $request->input('title');
        
                    $extension = $uploadedImage->getClientOriginalExtension();
        
                    $newFileName = $title . '.' . $extension;
        
                    $uploadedImage->storeAs($storagePath, $newFileName, 'public');
        
                    $validatedData['book_image'] = $newFileName;
                } else {
                    $newFileName = 'default-bookcover.jpg';
                    $validatedData['book_image'] = $newFileName;
                }
        
                $book = Book::create($validatedData);
        
                if ($book) {
                    return response()->json(['success' => 'Book added successfully.', 'book' => $book]);
                } else {
                    return response()->json(['error' => 'Failed to save book.']);
                }
        
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to save book.',
                    'message' => $e->getMessage()
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }


        
        public function update(Request $request, $book_id)
        {
            if (!$request->isMethod('put')) {
                return response()->json(['error' => 'Method Not Allowed'], 405);
            }
        
            try {
                $book = Book::find($book_id);
        
                if (!$book) {
                    return response()->json(['error' => 'Book not found'], 404);
                }
        
                $validatedData = $request->validate([
                    'title' => 'nullable|string',
                    'author' => 'nullable|string',
                    'location_rack' => 'nullable|string',
                    'status' => 'nullable|string',
                    'isbn' => 'nullable|string',
                    'category' => 'nullable|string',
                    'condition' => 'nullable|string',
                    'book_image' => 'nullable|image|mimes:jpeg,png,jpg',
                    'edition' => 'nullable|string',
                    'publisher' => 'nullable|string',
                    'copyright_year' => 'nullable|numeric',
                    'accession_number' => 'nullable|string',
                    'description' => 'nullable|string',
                ]);
        
                if ($request->hasFile('book_image')) {
                    if ($book->book_image && Storage::disk('public')->exists('books/' . $book->book_image)) {
                        Storage::disk('public')->delete('books/' . $book->book_image);
                    }
        
                    $uploadedImage = $request->file('book_image');
                    $storagePath = 'books';
                    $title = $request->input('title');
                    $extension = $uploadedImage->getClientOriginalExtension();
                    $newFileName = $title . '.' . $extension;
                    $uploadedImage->storeAs($storagePath, $newFileName, 'public');
                    $validatedData['book_image'] = $newFileName;
                }
        
                $book->update($validatedData);
        
                return response()->json(['success' => 'Book updated successfully.', 'book' => $book]);
        
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to update book.',
                    'message' => $e->getMessage()
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        
        
        



    public function show ($book_id)
    {
        $book = Book::find($book_id);
    
        if ($book) {
            return response()->json($book);
        } else {
            return response()->json(['error' => 'Book not found'], 404);
        }
    }
    

    public function destroy($book_id)
    {
        Book::find($book_id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
}