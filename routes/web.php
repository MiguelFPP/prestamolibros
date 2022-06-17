<?php

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
    Route::get('/', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors.index');
    Route::get('/create', [App\Http\Controllers\AuthorController::class, 'create'])->name('authors.create');
    Route::post('/store', [App\Http\Controllers\AuthorController::class, 'store'])->name('authors.store');
    Route::put('/{author}', [App\Http\Controllers\AuthorController::class, 'update'])->name('authors.update');
    Route::get('/{author}/edit', [App\Http\Controllers\AuthorController::class, 'edit'])->name('authors.edit');
    Route::delete('/{author}', [App\Http\Controllers\AuthorController::class, 'destroy'])->name('authors.destroy');
});

/* grupo de rutas category */
Route::prefix('category')->group(function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::get('/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::delete('/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
});
