<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        

        // Paginate the result
         $result = $query->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $result->items(),
            'links' => $result->links()->toHtml(),
        ]);
     
    }
    
    

    public function showReturnHistory(Request $request)
    {
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
    
            // Paginate the result
            $result = $query->paginate($limit, ['*'], 'page', $page);

            return response()->json([
                'data' => $result->items(),
                'links' => $result->links()->toHtml(),
            ]);
      
    }

  
   
    // public function showReturnHistory(Request $request)
    // {
    //     $page = $request->input('page', 1);
    //     $limit = max($request->input('limit', 10), 1); // Ensure a minimum limit of 1
    //     $search = $request->input('search');
    
    //     if ($request->expectsJson()) {
    //         $query = ReturnHistory::with(['borrower', 'book', 'borrowHistory']);
            
    //         // Apply search filter if search value is present
    //         if ($request->filled('search')) {
    //             $search = $request->input('search');
    //             $query->where(function ($subQuery) use ($search) {
    //                 $subQuery->where('id', 'like', '%' . $search . '%')
    //                     ->orWhereHas('borrower', function ($subQuery) use ($search) {
    //                         $subQuery->where('name', 'like', '%' . $search . '%')
    //                             ->orWhere('type', 'like', '%' . $search . '%');
    //                     })
    //                     ->orWhereHas('borrowHistory', function ($subQuery) use ($search) {
    //                         $subQuery->where('borrow_id', 'like', '%' . $search . '%');
    //                     })
    //                     ->orWhereHas('book', function ($subQuery) use ($search) {
    //                         $subQuery->where('title', 'like', '%' . $search . '%');
    //                     });
    //             });
    //         }
    
    //         // Paginate the result
    //         $result = $query->paginate($limit, ['*'], 'page', $page);
    
    //         // Add pagination links to the result
    //         $result->appends(['search' => $search]); // Append search parameter to pagination links
    
    //         return response()->json([
    //             'data' => $result->items(),
    //             'links' => $result->links()->toHtml(),
    //         ]);
    //     } else {
    //         return response()->json(['error' => 'Invalid Request'], 400);
    //     }
    // }
    
    



  


    public function show($book_id) {

        $display = BorrowHistory::with('borrower')
        ->where('book_id', $book_id)
        ->orderBy('created_at', 'desc') // Order by created_at in descending order
        ->limit(10) // Limit the results to the most recent 5 records
        ->get();
    
        
        if ($display->isNotEmpty()) {
            return response()->json(['success' => 'History Loaded.', 'data' => $display]);
        } else {
            return response()->json(['error' => 'No History Found', 'data' => $display]);
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