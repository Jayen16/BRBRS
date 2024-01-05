<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BooksController extends Controller
{


    public function displayBooks()
    {
      
        return view('listbook');
   
    }



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::latest()->get();
    
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook" >Edit</button>';
    
                        $btn .= ' <button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</button>';
    
                        $btn .= ' <a href="/description/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Borrow" class="btn btn-warning btn-sm borrowBook">Transaction</a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }elseif ($request->expectsJson() || $request->isJson() || $request->wantsJson() || $request->acceptsJson()) {
            $data = Book::latest()->get();
            return response()->json($data, Response::HTTP_OK);

        }else {
            return response()->json(['error' => 'Invalid Request'], 400);
        }
    }
    


    public function show($category)
        {
            
        // Check if the selected category exists in the database
        if ($category === null || $category == 'All Categories') {
            $books = Book::all(); 
        } else {
            $categoryExists = Book::where('category', $category)->exists();
        
            if (!$categoryExists) {
                $books = collect(); 
            } else {
                $books = Book::where('category', $category)->get();
            }
        }
        
        return DataTables::of($books)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook">Edit</button>';
        
                $btn .= ' <button href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</button>';
        
                $btn .= ' <a href="/api/description/'.$row->id.'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Borrow" class="btn btn-warning btn-sm borrowBook">Transaction</a>';
        
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);  

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
                
                // Check if book_number_id exists in the request
                if ($request->has('id')) {
                    $book = Book::find($request->book_number_id);
                    
                    if ($book) {
                        $book->update($validatedData);
                    }
                } else {
                    $book = Book::create($validatedData);
                }
        
                if ($book) {
                    return response()->json(['success' => 'Book saved successfully.', 'book' => $book]);
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




    public function editBook($id)
    {
        $book = Book::find($id);
    
        if ($book) {
            return response()->json($book);
        } else {
            return response()->json(['error' => 'Book not found'], 404);
        }
    }
    

    public function destroy($id)
    {
        Book::find($id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
}
