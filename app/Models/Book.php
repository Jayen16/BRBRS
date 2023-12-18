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


    public function bookhistory()
    {
        return $this->belongsTo(BorrowHistory::class, 'id', 'book_id');
    }




}
