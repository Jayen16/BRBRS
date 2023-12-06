<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatronController extends Controller
{
    public function index(Request $request)
    {
   
        // $books = Book::latest()->get();
        
        // if ($request->ajax()) {
        //     $data = Book::latest()->get();
        //     return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
   
        //                    $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook" >Edit</button>';
   
        //                    $btn = $btn.' <button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</button>';


                           
    
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
        // return view('borrowreturn',compact('books'));

        return view('patron');
   
    }

}
