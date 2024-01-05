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




// Route::middleware(['auth','librarian'])->group(function () {

    //DASHBOARD VIEW
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    //PATRON VIEW
    Route::get('/patron', [PatronController::class, 'displayPatrons'])->name('patron');

    //BOOK VIEW
    Route::get('/listbooks', [BooksController::class, 'displayBooks'])->name('listbooks'); 

    //HISTORY OF BORROW AND RETURN VIEW
    Route::get('/borrowing/history', [BorrowReturnController::class, 'index'])->name('historybooks');



 // <---------------------------------------------JAKE----------------------------------------------->
  // <-------------------------------------------------------------------------------------------------->
  // <-------------------------------ETO YUNG ILILIPAT MO SA api.php , -------------------------------->

    Route::delete('/deletebook/{id}', [BooksController::class, 'destroy'])->name('deletebook');
    Route::get('/edit/book/{id}', [BooksController::class, 'editBook'])->name('editbook');
    Route::get('/listbooks/{category}', [BooksController::class, 'show'])->name('showcategory');
    
    Route::get('/description/book/{id}', [BorrowController::class, 'show'])->name('description');
    Route::get('/description/{id}', [BorrowController::class, 'displayshow'])->name('displaydescription');
    Route::get('/description/{transaction}/{id}/{patron_id}', [BorrowController::class, 'borrow'])->name('borrow');

    Route::get('/history/book/{id}', [BorrowReturnController::class, 'show'])->name('displayhistory');
    Route::get('/history/borrow', [BorrowReturnController::class, 'displayBorrow'])->name('BorrowHistory');
    Route::get('/history/return', [BorrowReturnController::class, 'displayReturn'])->name('ReturnHistory');

    // Pag nilipat mo yung route from web.php to api.php , you have to add /api sa mga ajax kasi..
    //.. yung api.php matik may /api sa url, so for example /deletebook/{id} magiging /api/deletebook/{id}
    // IMPORTANT NOTE: everytime may new route ..run this command "php artisan route:list" para makilala ni api.php na may bagong route

    // sa code naman , pacheck sa PatronController.php, gamitin ung mga name na "store" , "destroy" , "show" ,"index", "update"
    // paki-separate yung may mga updateOrCreate, gawan ng sariling route na "PUT" 

    //take note din , sa mga "store" ,"destroy" usually ginagamitan ng try and catch function yan
    // tapos... laging may response json for success at failed , kasi yan din titingnan ni sir..
    // ..for example sa PatronController ulit sa "store" may validation dyan line 83-94 , yan ung mag aappear as error like incomplete input.. or already existing school id
   
    // <-------------------------------------------------------------------------------------------------->
    // <-------------------------------------------------------------------------------------------------->
     // <-------------------------------------------------------------------------------------------------->

// });


Route::middleware(['self-register'])->group(function () {
    Route::match(['get', 'post'], '/google/logout', [GoogleController::class, 'logoutGoogle'])->name('logout.google');
    Route::get('/register/librarian', [GoogleController::class, 'redirectToRegister'])->name('register.librarian');
    
});


Route::group(['prefix' => 'auth'], function () {
    Route::get('google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('googlelogin');
    Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
 
});