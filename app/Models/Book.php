<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title', 'author'
    // ];

    protected $guarded = [];


    public function bookBorrowhistory()
    {
        return $this->belongsTo(BorrowHistory::class, 'id', 'book_id');
    }

    public function bookReturnhistory()
    {
        return $this->belongsTo(ReturnHistory::class, 'id', 'book_id');
    }

}
