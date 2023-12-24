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
    
    // public $gotId;

    public function index(Request $request)
    {
   
        $books = Book::latest()->get();
      
        return view('listbook',compact('books'));
   
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
        // $this->gotId = $id;
        // return view('bookdescription');
        return view('bookdescription',compact('id'));
    }


    public function borrow($transaction,$id,$rfid_id)
    {
         //  see  if may available
        // pacheck ung patron kung existing,,, narecord kahit iba rfidid

        $checkIfPatronExists = Patron::where('patron_id',$rfid_id)->exists();
        $checkIfBookExists = Book::where('id',$id)->exists();
        // $checkIfBookExists = Book::where('id',$id)->where('status','available')->exists();

        if($checkIfBookExists){
            // okay pasok, available daw sya

            if($checkIfPatronExists){
                //okay pasok, existing ung patron

                $availabilityOfBook =  Book::where('id',$id)->first();
                // $whoPatron = Patron::where('patron_id',$rfid_id)->first();

                if($availabilityOfBook->status ==='available' && $transaction ==='Borrow'){
                // kapag hihiram , need add new data sa borrow history, then sa book gawing 'borrowed'

                
                    $goodToBorrow =Book::where('id', $id)
                    ->update(['status' => 'borrowed']); 
                    
                    if($goodToBorrow){
                        $recordBorrow = new BorrowHistory();
                        $recordBorrow->book_id = $id; 
                        $recordBorrow->borrower_id = $rfid_id; 
                        $recordBorrow->borrow_status = 'borrowed'; 
                        $recordBorrow->save();
    
                    
                        return response()->json(['success' => 'The book has been borrowed'], 200);
                    }else{
                        return response()->json(['error' => 'already borrowed by other patrons'], 400);
                    }
        


                }elseif($availabilityOfBook->status ==='borrowed' && $transaction ==='Return'){
                    // kapag nireturn , need update sa borrow history, add new data sa return history,  then sa book gawing 'available'

                   
                   $whoBorrowed= BorrowHistory::where('book_id', $id)
                    ->where('borrower_id',$rfid_id)
                    ->update(['borrow_status' => 'returned']); 
                    
                    if($whoBorrowed){

                        $recordBorrow = new ReturnHistory();
                        $recordBorrow->book_id = $id; 
                        $recordBorrow->borrower_id = $rfid_id; 
                        $recordBorrow->return_status = 'returned'; 
                        $recordBorrow->save();
    
                        Book::where('id', $id)
                        ->update(['status' => 'available']); 

                        return response()->json(['success' => 'The book has been returned succesfully'], 200);
                    }else{

                        return response()->json(['error' => 'Wrong Patron'], 400);
                    }
                       

                }

            }
                    
    

        }else{
            // sorry hindi available
                return response()->json(['success' => 'The book is not existing'], 400);
        }

        


    }

}
