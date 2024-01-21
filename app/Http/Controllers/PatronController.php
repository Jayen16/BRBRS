<?php

namespace App\Http\Controllers;

use App\Models\Patron;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PatronController extends Controller
{

    public function displayPatrons()
    {
        return view('patron');
    }



    public function index(Request $request)
    {
        $type = $request->input('type');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 3);
        $search = $request->input('search');
        $sortColumn = $request->input('sortColumn', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');
    
        $query = Patron::query();
    
        if ($type) {
            $query->where('type', $type);
        }
    
        if ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('first_name', 'like', '%' . $search . '%')
                         ->orWhere('middle_name', 'like', '%' . $search . '%')
                         ->orWhere('last_name', 'like', '%' . $search . '%')
                         ->orWhere('school_id', 'like', '%' . $search . '%')
                         ->orWhere('patron_id', 'like', '%' . $search . '%');
            });
        }
    
        $query->orderBy($sortColumn, $sortOrder);
    
        $result = $query->paginate($limit, ['*'], 'page', $page);
    
        return response()->json([
            'data' => $result->items(),
            'links' => $result->links()->toHtml(),
        ]);
    }
    
    



    public function getPatronAndBook($patron_id, $book_id)
    {
        $patron = Patron::where('patron_id', $patron_id)->first();
        $book = Book::where('id', $book_id)->first();
    
        if ($patron) {
            if ($patron->registration_status == 'Registered') {
                if ($patron && $book) {
                    $data = [
                        'patron' => $patron,
                        'book' => $book,
                        'success' => true,
                        'message' => 'Existing patron',
                    ];
    
                    return response()->json($data);
                } else {
                    return response()->json(['error' => 'Book is not found'], 404);
                }
            } else {
                return response()->json(['error' => 'Patron is not currently registered.'], 404);
            }
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
            'patron_id' => 'required|string|unique:patrons,patron_id',
            'school_id' => 'required|string|unique:patrons,school_id',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'sex' => 'nullable|string',
            'type' => 'nullable|string',
            'program' => 'nullable|string',
            'registration_status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422); 
        }

        try {
            $data = $validator->validated(); 

            $patron = Patron::firstOrCreate(
                ['patron_id' => $data['patron_id'], 'school_id' => $data['school_id']],
                $data
            );

            return response()->json([
                'success' => 'Patron added successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Patron failed to add',
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


    public function update(Request $request, $school_id)
    {

           

        $existingPatron = Patron::where('patron_id', $request->input('patron_id'))->orWhere('school_id', $request->input('school_id'))->first();


        if ($existingPatron && $existingPatron->school_id == $school_id) {

  
            $validator = Validator::make($request->all(), [       
                'patron_id' => 'nullable|string' ,
                'first_name' => 'nullable|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'nullable|string',
                'sex' => 'nullable|string',
                'type' => 'nullable|string',
                'program' => 'nullable|string',
                'registration_status' => 'nullable|string',
            ]);
        

            if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 422); 
                }

                try {
                    $data = $validator->validated(); 

               
                    $existingPatron->update($data);

                    return response()->json([
                        'success' => 'Patron updated successfully.',
                        'data' => $existingPatron,
                    ]);

                } catch (\Exception $e) {
                    return response()->json([
                        'error' => 'An error occurred while processing the request.',
                        'message' => $e->getMessage()
                    ], 500);
                }


        }else{
            return response()->json(['error' => 'Patron failed update'], 422);

        }
     
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