<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowReturnController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardContent;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PatronController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return redirect()->route('login');
});




Auth::routes([
    'verify'=>true
]);



    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
        
    })->middleware(['auth', 'signed'])->name('verification.verify');


Route::middleware(['librarian'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/content', [DashboardContent::class, 'content'])->name('dashboard.content'); // dito na kunin pang display sa dashboard

    Route::get('/listbooks', [BooksController::class, 'index'])->name('listbooks'); 
    Route::post('/addbooks', [BooksController::class, 'store'])->name('addbooks'); 
    Route::delete('/deletebook/{id}', [BooksController::class, 'destroy'])->name('deletebook');
    Route::get('/editbook/{id}', [BooksController::class, 'edit'])->name('editbook');
    Route::get('/listbooks/{category}', [BooksController::class, 'show'])->name('showcategory');
    
    // Route for updating a book
    // Route::post('/books/update', [BookController::class, 'store'])->name('updatebook');
    
    Route::get('/patron', [PatronController::class, 'index'])->name('patron');
    Route::get('/patron/display', [PatronController::class, 'displayPatrons'])->name('PatronsList');
    Route::get('/editpatron/{id}', [PatronController::class, 'edit'])->name('editpatron');
    Route::post('/addpatrons', [PatronController::class, 'store'])->name('addpatrons');
    Route::delete('/deletepatron/{id}', [PatronController::class, 'destroy'])->name('deletepatron'); 
    Route::get('/patron/{id}/{book_id}', [PatronController::class, 'show'])->name('get_patron');
    
    
    Route::get('/description/book/{id}', [BorrowController::class, 'show'])->name('description');
    Route::get('/description/{id}', [BorrowController::class, 'displayshow'])->name('displaydescription');
    Route::get('/description/{transaction}/{id}/{patron_id}', [BorrowController::class, 'borrow'])->name('borrow');

    Route::get('/borrowing/history', [BorrowReturnController::class, 'index'])->name('historybooks');
    Route::get('/history/book/{id}', [BorrowReturnController::class, 'show'])->name('displayhistory');
    Route::get('/history/borrow', [BorrowReturnController::class, 'displayBorrow'])->name('BorrowHistory');
    Route::get('/history/return', [BorrowReturnController::class, 'displayReturn'])->name('ReturnHistory');

    Route::get('/category/display', [CategoryController::class, 'displayCategory'])->name('CategoryList');
    Route::delete('/delete/category/{category}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
    Route::post('/add/category', [CategoryController::class, 'addCategory'])->name('category.add');

    //GENERATE using PDF/DOMPDF (ayaw tumanggap ng javascript dito pag html na)...Datatable nalang may feature na PDF button

    // Route::get('/history/borrow/pdf', [BorrowReturnController::class, 'generateBorrowHistory'])->name('borrowPDF');
    // Route::get('/history/borrow/fetch', [BorrowReturnController::class, 'fetchBorrowHistory'])->name('fetchBorrowHistory');
    // Route::get('/history/return/pdf', [BorrowReturnController::class, 'generateReturnHistory'])->name('returnPDF');


});


Route::middleware(['self-register'])->group(function () {
    Route::match(['get', 'post'], '/google/logout', [GoogleController::class, 'logoutGoogle'])->name('logout.google');
    Route::get('/register/librarian', [GoogleController::class, 'redirectToRegister'])->name('register.librarian');
    
});





Route::group(['prefix' => 'auth'], function () {
    Route::get('google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('googlelogin');
    Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
 
});