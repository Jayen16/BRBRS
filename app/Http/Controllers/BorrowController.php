<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowHistory;
use App\Models\Patron;
use App\Models\ReturnHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BorrowController extends Controller
{
    


    public function index()
    {
        return view('bookdescription');
    }



    public function show($id)
    {
        $selectedBook = Book::find($id);
    
        if (!$selectedBook) {
            return response()->json(['error' => 'Book not found'], 404);
        }
    
        return response()->json(['book' => $selectedBook]);
    }


    public function displayshow($id)
    {
        return view('bookdescription',compact('id'));
    }




    public function borrow($transaction, $id, $rfid_id)
    {


        if($transaction ==='Borrow'){

            $checkIfBookExists = Book::where('id',$id)
            ->where('status','available')
            ->exists();


            $selectedBook =  Book::where('id',$id)->first();

            if($checkIfBookExists && $selectedBook->status ==='available'){
             
                    $goodToBorrow =Book::where('id', $id)
                    ->update(['status' => 'borrowed']); 
                    
                    if($goodToBorrow){
                        $recordBorrow = new BorrowHistory();
                        $recordBorrow->book_id = $id; 
                        $recordBorrow->borrower_id = $rfid_id; 
                        $recordBorrow->borrow_status = 'borrowed'; 
                        $recordBorrow->attending_librarian_id = auth()->user()->id ;
                        $recordBorrow->save();
    
                        return response()->json(['success' => 'The book is now borrowed by '.$recordBorrow->borrower->name], 200);

                    }else{

                        return response()->json(['error' => 'already borrowed by other patrons'], 404);
                    }
            }



        }elseif($transaction ==='Return'){

            $checkIfBookExists = Book::where('id',$id)
            ->where('status','borrowed')
            ->exists();

            $selectedBook =  Book::where('id',$id)->first();

            $checkIfBorrowerExists = BorrowHistory::where('book_id', $id)
            ->where('borrower_id', $rfid_id)
            ->where('borrow_status', 'borrowed')
            ->latest('created_at')
            ->first();

            if ($checkIfBookExists && $selectedBook->status ==='borrowed' ){
                // kapag nireturn , need update sa borrow history, add new data sa return history,  then sa book gawing 'available'

                if (isset($checkIfBorrowerExists->borrower_id) && $checkIfBorrowerExists->borrower_id !== null) {

                    $getBorrowId = BorrowHistory::where('book_id', $id)
                    ->where('borrower_id', $rfid_id)
                    ->where('borrow_status', 'borrowed')
                    ->latest('created_at')
                    ->first();
                
                     if ($getBorrowId) {

                            $getBorrowId->update(['borrow_status' => 'returned']);
                                         
                            $recordReturn = new ReturnHistory();
                            $recordReturn->book_id = $id;
                            $recordReturn->borrow_id = $getBorrowId->id;
                            $recordReturn->borrower_id = $rfid_id;
                            $recordReturn->attending_librarian_id = auth()->user()->id ;
                            $recordReturn->save();
                    
                            Book::where('id', $id)
                            ->update(['status' => 'available']);
                
                            return response()->json(['success' => 'The book has been returned successfully'], 200);

                        } else {

                            return response()->json(['error' => 'The book is not currently borrowed'], 404);
                            
                        }

                    } else {
                        
                        return response()->json(['error' => 'This patron is not the last borrower of this book'], 404);
                    }
                         

                    
                    
             }else{
                return response()->json(['error' => 'The book is not currently borrowed'], 404);
             }

        }


      }

}