<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BorrowHistory;
use App\Models\Patron;
use Illuminate\Http\Request;

class BorrowReturnController extends Controller
{
    
    public function index(Request $request)
    {
   
        return view('borrowreturn');
   
    }


    public function displayHistory(){

        $display = BorrowHistory::with('borrower')
        ->orderBy('created_at', 'asc') 
        ->limit(5) 
        ->get();
    
        if ($display->isNotEmpty()) {
            return response()->json(['success' => 'History Loaded.', 'data' => $display]);
        } else {
            return response()->json(['error' => 'No History Found', 'data' => $display]);
        }
    }

    // public function search(Request $request)
    // {
    //     $searchTerm = $request->input('term'); // Get the search term from the request

    //     // Perform the search using the Book model
    //     $borrow_history = BorrowHistory::with('borrower')
    //         ->where('book_id', 'like', '%' . $searchTerm . '%')
    //         ->orWhere('borrower_id', 'like', '%' . $searchTerm . '%')
    //         ->orWhere('borrow_status', 'like', '%' . $searchTerm . '%')
    //         ->orWhere('name', 'like', '%' . $searchTerm . '%')
    //         ->get();

    //     return response()->json(['borrow_history' => $borrow_history]); 

    // }


    public function show($id) {

        $display = BorrowHistory::with('borrower')
            ->where('book_id', $id)
            ->orderBy('created_at', 'asc') 
            ->limit(5) 
            ->get();
        
        if ($display->isNotEmpty()) {
            return response()->json(['success' => 'History Loaded.', 'data' => $display]);
        } else {
            return response()->json(['error' => 'No History Found', 'data' => $display]);
        }
    }
    
    
    
}
