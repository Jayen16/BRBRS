<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowReturnController;
use App\Http\Controllers\PatronController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('books', BooksController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/listbooks', [BooksController::class, 'index'])->name('listbooks'); 
// need may bracket sa Controller [BooksController] . kasi kapag wala , d mareread 

Route::post('/addbooks', [BooksController::class, 'store'])->name('addbooks'); 

// Route for deleting a book (change from POST to DELETE)
Route::delete('/deletebook/{id}', [BooksController::class, 'destroy'])->name('deletebook');

Route::get('/editbook/{id}', [BooksController::class, 'edit'])->name('editbook');

// Route for updating a book
// Route::post('/books/update', [BookController::class, 'store'])->name('updatebook');


Route::get('/borrowing/history', [BorrowReturnController::class, 'index'])->name('historybooks');



// Route::get('/patron', [PatronController::class, 'index'])->name('patron');

Route::get('/listbooks/{category}', [BooksController::class, 'show'])->name('showcategory');



Route::get('/patron', [PatronController::class, 'index'])->name('patron');
Route::get('/editpatron/{id}', [PatronController::class, 'edit'])->name('editpatron');
Route::post('/addpatrons', [PatronController::class, 'store'])->name('addpatrons');
Route::delete('/deletepatron/{id}', [PatronController::class, 'destroy'])->name('deletepatron'); 

Route::get('/patron/borrow/{id}/{book_id}', [PatronController::class, 'show'])->name('get_patron');


// Route::get('/descriptio', [BooksController::class, 'index'])->name('listbooks'); 
Route::get('/description/{id}', [BorrowController::class, 'show'])->name('description');

Route::get('/description/borrow/{id}/{patron_id}', [BorrowController::class, 'borrow'])->name('borrow');