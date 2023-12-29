<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BooksController extends Controller
{
    public function index(Request $request)
    {
   
        $books = Book::latest()->get();
        
        if ($request->ajax()) {
            $data = Book::latest()->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook" >Edit</button>';
   
                           $btn = $btn.' <button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</button>';

                           $btn = $btn.' <a href="/description/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Borrow" class="btn btn-warning btn-sm borrowBook">Transaction</a>';
                           
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('listbook',compact('books'));
   
    }


    public function show($category)
        {
            
        // Check if the selected category exists in the database
        if ($category === null || $category == 'All Categories') {
            $books = Book::all(); // Retrieve all books if category is null or 'All Categories'
        } else {
            $categoryExists = Book::where('category', $category)->exists();
        
            if (!$categoryExists) {
                $books = collect(); // Return an empty collection if the category doesn't exist
            } else {
                $books = Book::where('category', $category)->get();
            }
        }
        
        return DataTables::of($books)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook">Edit</button>';
        
                $btn .= ' <button href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</button>';
        
                $btn .= ' <a href="/description/'.$row->id.'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Borrow" class="btn btn-warning btn-sm borrowBook">Transaction</a>';
        
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);  

        }


    public function store(Request $request)
    {
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
        }else{

            $newFileName = 'default-bookcover.jpg';
            $validatedData['book_image'] = $newFileName;
        }
        
        
            $book = Book::updateOrCreate(['id' => $request->book_number_id], $validatedData);
        
            if ($book) {
                return response()->json(['success' => 'Book saved successfully.', 'book' => $book]);
            } else {
                return response()->json(['error' => 'Failed to save book.']);
            }
    }




    public function editBook($id)
    {
        $book = Book::find($id);
        
        return response()->json($book);
    }
  

    public function destroy($id)
    {
        Book::find($id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
}
