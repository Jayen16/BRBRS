<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BorrowHistory;
use App\Models\ReturnHistory;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardContent extends Controller
{


    public function content()
    {
        $borrowedBooksCount = BorrowHistory::where('borrow_status', '!=', 'returned')->count();
        $returnedBooksCount = ReturnHistory::count();
        $awaitingtoReturnBooksCount = BorrowHistory::where('borrow_status', '==', 'borrowed')->count();
        $numberOfLibrarians = User::count();

        return response()->json([
            'borrowed_books_count' => $borrowedBooksCount,
            'returned_books_count' => $returnedBooksCount,
            'awaiting_books_count' => $awaitingtoReturnBooksCount,
            'librarian_count' => $numberOfLibrarians,
        ]);

        // hindi pa nafefetch ng AJAX to for dashboard , pending task to
        // wala pa sariling icon yung sa user , standby lang to 
    }

}
