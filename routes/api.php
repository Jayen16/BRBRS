<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
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


Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::post('/auth/register', [AuthController::class, 'register'])->name('registerLibrarian');


Route::middleware('auth:sanctum')->group(function () {
    
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::get('/auth/user', [AuthController::class, 'user']);
    //accept application/json, authorizeion Bearer + 

    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware(['auth:sanctum'])->group(function () {


   //PATRON
    Route::get('/patron', [PatronController::class, 'index'])->name('PatronsList'); //index
    Route::post('/addpatrons', [PatronController::class, 'store'])->name('addpatrons'); //store and update  
    Route::get('/editpatron/{id}', [PatronController::class, 'show'])->name('editpatron'); //show
    Route::put('/updatepatron/{id}', [PatronController::class, 'update'])->name('updatepatron');
    Route::delete('/deletepatron/{id}', [PatronController::class, 'destroy'])->name('deletepatron');  // delete
    Route::get('/patron/{id}/{book_id}', [PatronController::class, 'getPatronAndBook'])->name('get_patron');// retrieve both patron and book

    //DASHBOARD
    Route::get('/dashboard/content', [DashboardContent::class, 'index'])->name('dashboard.content');//index dashboard content

    
    //CATEGORY

    Route::get('/category/display', [CategoryController::class, 'index'])->name('CategoryList'); // index
    Route::post('/add/category', [CategoryController::class, 'store'])->name('category.add'); //store
    Route::delete('/delete/category/{category}', [CategoryController::class, 'destroy'])->name('category.delete'); //destroy
    Route::get('/listbooks/{category}', [BooksController::class, 'showCategory'])->name('showcategory'); // PANG SPECIFIC NA CAREGORY DISPLAY
    
    //BOOK
    // Route::get('/listbooks/display/{sort}', [BooksController::class, 'index'])->name('BookList'); 
    // Route::get('/listbooks/display', [BooksController::class, 'index'])->name('BookList'); // PANG ALL DISPLAY

    Route::get('/edit/book/{id}', [BooksController::class, 'show'])->name('editbook'); // show book
    Route::put('/updatebook/{id}', [BooksController::class, 'update'])->name('updatebook');
    Route::post('/addbooks', [BooksController::class, 'store'])->name('addbooks'); // store  book 
    Route::delete('/deletebook/{id}', [BooksController::class, 'destroy'])->name('deletebook'); 

    //DESC
    Route::get('/description/book/{id}', [BorrowController::class, 'show'])->name('description'); 
    Route::get('/description/{transaction}/{id}/{patron_id}', [BorrowController::class, 'borrow'])->name('borrow'); 

    //HISTORY
    Route::get('/history/book/{id}', [BorrowReturnController::class, 'show'])->name('displayhistory'); 
    Route::get('/history/borrow', [BorrowReturnController::class, 'showBorrowHistory'])->name('BorrowHistory');
    Route::get('/history/return', [BorrowReturnController::class, 'showReturnHistory'])->name('ReturnHistory'); 


});
