<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    public function borrowerHistory()
    {
        return $this->belongsTo(BorrowHistory::class, 'patron_id', 'borrower_id');
    }
    

    
    public function returnHistory()
    {
        return $this->belongsTo(ReturnHistory::class, 'patron_id', 'borrower_id');
    }
    
}
