<?php

namespace App\Http\Controllers;

use App\Models\Patron;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PatronController extends Controller
{

    public function displayPatrons()
    {
        return view('patron');

    }


    public function index(Request $request)
    {
        $type = $request->input('type');
        $data = Patron::where('type', $type)->latest()->get(); 

        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="addNewPatron"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPatron" >Edit</button>';
                        $btn .= ' <button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePatron">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }elseif ($request->expectsJson() || $request->isJson() || $request->wantsJson() || $request->acceptsJson()) {
            $data = [
                'students' => Patron::where('type', 'student')->latest()->get(),
                'faculty' => Patron::where('type', 'faculty')->latest()->get(),
                'staff' => Patron::where('type', 'staff')->latest()->get(),
                'guests' => Patron::where('type', 'guest')->latest()->get()
            ];
    
            return response()->json($data, Response::HTTP_OK);
            
        }
    }



    public function getPatronAndBook($id ,$book_id)
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
        
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Patron is not found'], 404);
        }
        
    }


    public function store(Request $request)
    {

        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'Method Not Allowed'], 405);
        }

        $validator = Validator::make($request->all(), [
            'patron_id' => 'required|string|unique:patrons,patron_id,'.$request->id.',id',
            'school_id' => 'required|string|unique:patrons,school_id,'.$request->id.',id',
            'name' => 'required|string',
            'course' => 'required|string',
            'sex' => 'nullable|string',
            'type' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422); 
        }
    
        try {
            $data = $validator->validated(); 
    
            $patron = Patron::updateOrCreate(['id' => $request->id], $data);
    
            return response()->json([
                'success' => 'Patron ' . ($patron->wasRecentlyCreated ? 'added' : 'updated') . ' successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while processing the request.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    



    public function show($id)
    {
        $patron = Patron::find($id);
    
        if (!$patron) {
            return response()->json(['error' => 'Patron not found'], 404);
        }
    
        return response()->json($patron);
    }
  

    public function destroy($id)
    {
        try {
            $patron = Patron::find($id);
    
            if (!$patron) {
                return response()->json(['error' => 'Patron not found.'], 404);
            }
    
            $patron->delete();
    
            return response()->json(['success' => 'Patron deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete patron.', 'message' => $e->getMessage()], 500);
        }
    }
    

}
