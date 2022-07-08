<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => true, 'verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Auth::routes(['register' => true, 'verify' => true]);

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth'); */

/* grupo de rutas author */
Route::prefix('author')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('/store', [AuthorController::class, 'store'])->name('authors.store');
    Route::put('/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
});

/* grupo de rutas category */
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

/* grupo de rutas book */
Route::prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::get('/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/store', [BookController::class, 'store'])->name('books.store');
    Route::put('/{book}', [BookController::class, 'update'])->name('books.update');
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});


Route::prefix('admin')->group(function () {
    Route::get('/user',[UserController::class, 'index'])->name('admin.users.index');
    Route::get('/user/create',[UserController::class, 'create'])->name('admin.users.create');
    Route::post('/user/store',[UserController::class, 'store'])->name('admin.users.store');
    Route::put('/user/{user}',[UserController::class, 'update'])->name('admin.users.update');
    Route::get('/user/{user}/edit',[UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/user/{user}',[UserController::class, 'destroy'])->name('admin.users.destroy');
});

/* grupo de rutas para prestamos */
Route::prefix('loan')->group(function () {
    Route::get('/', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/store', [LoanController::class, 'store'])->name('loans.store');
    Route::put('/{loan}', [LoanController::class, 'update'])->name('loans.update');
    Route::get('/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
    Route::delete('/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
    ///////////////////////////////////////////////////////////////////////////////////////
    Route::get('/users-loan', [LoanController::class, 'usersLoan'])->name('loans.users_loan');
    Route::get('/books-loan', [LoanController::class, 'booksLoan'])->name('loans.books_loan');
    Route::post('add-book/{id}', [LoanController::class, 'addBook'])->name('loans.add_book');
    Route::post('remove-book/{id}', [LoanController::class, 'removeBook'])->name('loans.remove_book');
    Route::get('show-cart', [LoanController::class, 'showLoanSelected'])->name('loans.show_cart_loan');
    Route::get('clean-loan', [LoanController::class, 'cleanBooks'])->name('loans.clean_loan');
});
