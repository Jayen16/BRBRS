<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowHistory;
use App\Models\Patron;
use App\Models\ReturnHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class BorrowReturnController extends Controller
{
    
    public function index(Request $request)
    {
   
        return view('borrowreturn');
   
    }


    
    public function showBorrowHistory(Request $request)
    {
        $sortColumn = $request->input('sortColumn', 'created_at');
        $sortOrder = $request->input('sortOrder', 'asc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10); // Ensure a minimum limit of 1
        $search = $request->input('search');

        
        $query = BorrowHistory::with(['borrower', 'book']);

        if ($search) {
            $searchTerm = strtolower(trim($search)); // Convert to lowercase and trim whitespace
        
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('borrow_status', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('borrower', function ($subQuery) use ($searchTerm) {
                        $subQuery->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('book', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('title', 'like', '%' . $searchTerm . '%')
                                  ->orWhere('status', 'like', '%' . $searchTerm . '%');
                    });
            });
        }
        
        $query->orderBy($sortColumn, $sortOrder);
        $result = $query->paginate($limit, ['*'], 'page', $page);

        if ($result->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'error' => 'No borrow history records found.',
            ], 404);
        }
        


        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Borrowing history loaded.',
            'data' => $result->items(),
            'links' => $result->links()->toHtml(),
        ], 200);
        
     
    }
    
    

    public function showReturnHistory(Request $request)
    {
        $sortColumn = $request->input('sortColumn', 'created_at');
        $sortOrder = $request->input('sortOrder', 'asc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10); // Ensure a minimum limit of 1
        $search = $request->input('search');

        $query = ReturnHistory::with(['borrower', 'book', 'borrowHistory']);

        
        if ($search) {
        
            $query->where(function ($subQuery) use ($search) {
                $subQuery->orWhereHas('borrower', function ($subQuery) use ($search) {
                    $subQuery->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $search . '%');
                })
                ->orWhereHas('book', function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%');
                });
            });
        }
    
            $query->orderBy($sortColumn, $sortOrder);
            $result = $query->paginate($limit, ['*'], 'page', $page);

            
            if ($result->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'error' => 'No return history records found.',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Returning history loaded.',
                'data' => $result->items(),
                'links' => $result->links()->toHtml(),
            ], 200);
      
    }

  


  


    public function show($book_id) {

        $display = BorrowHistory::with('borrower')
        ->where('book_id', $book_id)
        ->orderBy('created_at', 'desc') 
        ->limit(5) 
        ->get();
    
        
        if ($display->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'This book\'s History Loaded.',
                'data' => $display,
            ], 200);
        } elseif(!Book::where('id',$book_id)->exists()){
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'This book\'s id is not existing.',
            ], 404);

        } else {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'This book\'s No History founded.',
                'data' => $display,
            ], 404);
        }
        
    }
    
    

    // public function generateBorrowHistory()
    // {

    //     $pdf = PDF::loadView('pdf.borrow-pdf')->setPaper('a4', 'landscape');
    //     return $pdf->download('borrow_history.pdf');
    // }

    // public function fetchBorrowHistory()
    // {
    //     $borrowHistory = BorrowHistory::get();

    //     return response()->json($borrowHistory);
    // }


    // public function generateReturnHistory(){
    
    // }

    
}