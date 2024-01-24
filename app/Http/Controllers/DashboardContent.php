<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BorrowHistory;
use App\Models\ReturnHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardContent extends Controller
{


    public function index()
    {
        try {

            $currentDate = Carbon::now()->toDateString();
            $sessionId = session('user_id');

            $borrowedBooksCount = BorrowHistory::where(function ($query) use ($sessionId) {
                $query->where('borrow_status', '!=', 'returned')
                      ->orWhere('borrow_status', '!=', 'failed to return');
            })
            ->whereDate('updated_at', $currentDate)
            ->where('attending_librarian_id', $sessionId)
            ->count();
        
            
            $returnedBooksCount = ReturnHistory::whereDate('updated_at', $currentDate)
                ->where('attending_librarian_id',$sessionId)
                ->count();
            
            $awaitingtoReturnBooksCount = BorrowHistory::where('borrow_status', 'borrowed')
                ->whereDate('updated_at', $currentDate)
                ->where('attending_librarian_id',$sessionId)
                ->count();

            $total_borrowed_count = BorrowHistory::where(function ($query) {
                $query->where('borrow_status', '!=', 'returned')
                        ->orWhere('borrow_status', '!=', 'failed to return');
            })
            ->count();
            
            $total_returned_count = ReturnHistory::count();
            $total_awaiting_count = BorrowHistory::where('borrow_status', 'borrowed')->count();


            $numberOfLibrarians = User::count();
    
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'borrowed_books_count' => $borrowedBooksCount,
                'returned_books_count' => $returnedBooksCount,
                'awaiting_books_count' => $awaitingtoReturnBooksCount,
                'total_borrowed_count' => $total_borrowed_count,
                'total_returned_count' => $total_returned_count,
                'total_awaiting_count' => $total_awaiting_count,
                'librarian_count' => $numberOfLibrarians,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'error' => 'An error occurred while processing the request.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
}