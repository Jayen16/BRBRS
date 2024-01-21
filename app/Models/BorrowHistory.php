<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowHistory extends Model
{
    use HasFactory;
    
    protected $guarded = [];



    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }


    public function borrower()
    {
        return $this->belongsTo(Patron::class, 'borrower_id', 'patron_id');
    }
    

    public function returnHistory()
    {
        return $this->belongsTo(BorrowHistory::class, 'id', 'borrow_id');
    }

}
