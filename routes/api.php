<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PatronController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowReturnController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardContent;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PatronController;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::middleware('auth:sanctum')->group( function () {
//     return $request->user();
// });

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);


// Route::middleware(['librarian'])->group(function () {


//PATRON
Route::get('/patron', [PatronController::class, 'index'])->name('PatronsList'); //index
Route::post('/addpatrons', [PatronController::class, 'store'])->name('addpatrons'); //store and update   <---- *separate the store and update
Route::get('/editpatron/{id}', [PatronController::class, 'show'])->name('editpatron'); //show
Route::delete('/deletepatron/{id}', [PatronController::class, 'destroy'])->name('deletepatron');  // delete
Route::get('/patron/{id}/{book_id}', [PatronController::class, 'getPatronAndBook'])->name('get_patron');// retrieve both patron and book

//DASHBOARD
Route::get('/dashboard/content', [DashboardContent::class, 'content'])->name('dashboard.content');//index dashboard content

 
//CATEGORY

Route::get('/category/display', [CategoryController::class, 'index'])->name('CategoryList'); // index
Route::post('/add/category', [CategoryController::class, 'store'])->name('category.add'); //store
Route::delete('/delete/category/{category}', [CategoryController::class, 'destroy'])->name('category.delete'); //destroy


//BOOK
Route::get('/listbooks/display', [BooksController::class, 'index'])->name('BookList'); // index
Route::get('/edit/book/{id}', [BooksController::class, 'editBook'])->name('editbook'); // show book
Route::post('/addbooks', [BooksController::class, 'store'])->name('addbooks'); // store and update book <---- *separate the store and update




// });
    // Route::get('/api/patron/display', [PatronController::class, 'displayPatrons'])->name('PatronsList');
