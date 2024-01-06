<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// NEW LOAN (POST) ------ DONE -------
Route::post('/newloan', [LoanController::class, 'loanCreate']);

// LOAN LIST (GET) ------ DONE -------
Route::get('/loans', [LoanController::class, 'index']) ;

// LOAN DETAIL (GET) ------ DONE -------
Route::get('/loans/{id}', [LoanController::class, 'show']); 

// LOAN RETURN (UPDATE)
Route::put('/loans/return/{loanID}/{bookID}', [LoanController::class, 'returnBook']);

// BOOK LIST - CATALOG (GET) ------ DONE -------
Route::get('/books', [BookController::class, 'index']);

// BOOK DETAIL ? (GET)
Route::get('/books/{id}', [BookController::class, 'show']);

// NEW BOOK (POST)
Route::post('/books/create', [BookController::class, 'insertProduct']);

// UPDATE BOOK (PUT)
Route::put('/books/{id}/update', [BookController::class, 'updateBook']);

Route::get('/images/{id}', [ImageController::class, 'show']);

// MEMBER LIST (GET) ------ DONE -------
Route::get('/members', [MemberController::class, 'index']) ;

// NEW MEMBER (POST) ------ DONE -------
Route::post('/members/create', [MemberController::class, 'newMember']);



Route::delete('/products/{id}/delete', [ProductController::class, 'deleteProduct']);
Route::get('/products/{id}/restore', [ProductController::class, 'restoreProduct']);
// Route::get('/product/image/{id}', 'ProductController@getImage')->name('product.image');


