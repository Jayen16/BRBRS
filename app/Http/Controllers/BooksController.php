<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
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

                           $btn = $btn.' <a href="/description/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Borrow" class="btn btn-warning btn-sm borrowBook">Borrow</a>';
                           
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('listbook',compact('books'));
   
    }


    public function show($category)
    {
            $filteredBooks = Book::where('category', $category)->get();
            return DataTables::of($filteredBooks)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook" >Edit</button>';

                    $btn = $btn.' <button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</button>';


                    

                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            // for filtering itong show
            // goods na yung $filteredBooks , hindi lang maipalabas sa client side arte
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
            'book_image' => 'nullable|string', 
            'edition' => 'nullable|string',
            'publisher' => 'nullable|string',
            'copyright_year' => 'nullable|numeric',
            'accession_number' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
    
        // Now that the data is validated, proceed to store it
        Book::updateOrCreate(['id' => $request->book_id], $validatedData);
    
        return response()->json(['success' => 'Book saved successfully.']);
    }

    public function edit($id)
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
