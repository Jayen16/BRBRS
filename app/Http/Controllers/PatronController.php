<?php

namespace App\Http\Controllers;

use App\Models\Patron;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PatronController extends Controller
{

    public function index()
    {
        return view('patron');

    }

    public function displayPatrons(Request $request){
        if ($request->ajax()) {
            $type = $request->input('type');
            $data = Patron::where('type', $type)->latest()->get(); 
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="addNewPatron"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPatron" >Edit</button>';
                        $btn = $btn.' <button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePatron">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        } 
        $data = [
            'students' => Patron::where('type', 'student')->latest()->get(),
            'faculty' => Patron::where('type', 'faculty')->latest()->get(),
            'staff' => Patron::where('type', 'staff')->latest()->get(),
            'guests' => Patron::where('type', 'guest')->latest()->get()
        ];
        return response()->json($data);
    }


    public function show($id ,$book_id)
    {
        $patron = Patron::where('patron_id', $id)->first();
        $book = Book::where('id', $book_id)->first();
        
        if ($patron && $book) {
            
            $data = [
                'patron' => $patron,
                'book' => $book,
                'success' => true,
                'message' => 'Existing patron',
            ];
        
            // Return the combined data as a JSON response
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Patron is not found'], 404);
        }
        
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'patron_id' => 'required|string',
            'school_id' => 'required|string',
            'name' => 'required|string',
            'course' => 'required|string', 
            'sex' => 'nullable|string', 
            'type' => 'required|string',
        ]);
    
        // Now that the data is validated, proceed to store it
        Patron::updateOrCreate(['id' => $request->id], $validatedData);
    
        return response()->json(['success' => 'Patron added successfully.']);
    }

    public function edit($id)
    {
        $patron = Patron::find($id);
        
        return response()->json($patron);
    }
  

    public function destroy($id)
    {
        Patron::find($id)->delete();
     
        return response()->json(['success'=>'Patron deleted successfully.']);
    }


    

}
