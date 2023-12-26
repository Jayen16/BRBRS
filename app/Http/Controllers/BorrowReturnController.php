<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BorrowHistory;
use App\Models\Patron;
use App\Models\ReturnHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class BorrowReturnController extends Controller
{
    
    public function index(Request $request)
    {
   
        return view('borrowreturn');
   
    }


    public function displayBorrow(Request $request)
    {
        if ($request->ajax()) {
            $data = BorrowHistory::query();
            
    
            // Apply search filter if search value is present
            if ($request->has('search') && !empty($request->input('search'))) {
                $search = $request->input('search');
                $data->where(function ($query) use ($search) {
                    $query->where('id', 'like', '%' . $search . '%')
                        ->orWhereHas('borrower', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('type', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('book', function ($query) use ($search) {
                            $query->where('title', 'like', '%' . $search . '%');
                        });
                });
            }
    
            // Fetch data with DataTables query builder
            return DataTables::of($data)
                ->addColumn('patron_name', function ($borrowHistory) {
                    return $borrowHistory->borrower->name;
                })
                ->addColumn('patron_type', function ($borrowHistory) {
                    return $borrowHistory->borrower->type;
                })
                ->addColumn('book_title', function ($borrowHistory) {
                    return $borrowHistory->book->title;
                })
                ->make(true);
        } else {
            return response()->json(['error' => 'Invalid Request'], 400);
        }
    }

    
    

   
    public function displayReturn(Request $request)
    {
        if ($request->ajax()) {
            $data = ReturnHistory::query();
            
    
            // Apply search filter if search value is present
            if ($request->has('search') && !empty($request->input('search'))) {
                $search = $request->input('search');
                $data->where(function ($query) use ($search) {
                    $query->where('id', 'like', '%' . $search . '%')
                        ->orWhereHas('borrower', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('type', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('borrowHistory', function ($query) use ($search) {
                            $query->where('borrow_id', 'like', '%' . $search . '%'); 
                        })
                        ->orWhereHas('book', function ($query) use ($search) {
                            $query->where('title', 'like', '%' . $search . '%');
                        });
                });
                
            }
    
            // Fetch data with DataTables query builder
            return DataTables::of($data)
                ->addColumn('id', function ($returnHistory) {
                    return $returnHistory->borrowHistory->id;
                })
                ->addColumn('patron_name', function ($returnHistory) {
                    return $returnHistory->borrower->name;
                })
                ->addColumn('borrow_id', function ($returnHistory) {
                    return $returnHistory->borrowHistory->id;
                })
                ->addColumn('patron_type', function ($returnHistory) {
                    return $returnHistory->borrower->type;
                })
                ->addColumn('book_title', function ($returnHistory) {
                    return $returnHistory->book->title;
                })
                ->make(true);
        } else {
            return response()->json(['error' => 'Invalid Request'], 400);
        }
    }




    public function show($id) {

        $display = BorrowHistory::with('borrower')
        ->where('book_id', $id)
        ->orderBy('created_at', 'desc') // Order by created_at in descending order
        ->limit(5) // Limit the results to the most recent 5 records
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
