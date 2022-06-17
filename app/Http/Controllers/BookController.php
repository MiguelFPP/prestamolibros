<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * The index function is a public function that returns a view of the books index page
     *
     * @return The index view is being returned.
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(6);
        return view('books.index', compact('books'));
    }

    /**
     * The `create()` function returns a view called `books.create` and passes the `authors` and
     * `categories` variables to the view
     *
     * @return A view called books.create, with the authors and categories variables.
     */
    public function create()
    {
        $authors = Author::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('books.create', compact('authors', 'categories'));
    }

    /**
     * The `store` function creates a new book, and then associates the categories that were selected
     * in the form with the book
     *
     * @param BookRequest request The request object.
     *
     * @return A redirect to the index view with a message.
     */
    public function store(BookRequest $request)
    {
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect()->route('books.index')->with('info', 'Libro creado con éxito');
    }

    /**
     * The edit function takes a Book object as a parameter, and returns a view with the authors,
     * categories, and book objects
     *
     * @param Book book This is the book that we're editing.
     *
     * @return The edit view is being returned.
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('books.edit', compact('authors', 'categories', 'book'));
    }

    /**
     * We're updating the book with the request data, and then we're syncing the categories with the
     * request categories
     *
     * @param BookRequest request The request object.
     * @param Book book The model instance passed to the route
     *
     * @return The book is being updated with the new information and the categories are being synced
     * with the new categories.
     */
    public function update(BookRequest $request, Book $book)
    {
        $book = Book::findOrFail($book->id);
        $book->update($request->all());
        $book->categories()->sync($request->categories);
        return back()->with('info', 'Libro actualizado con éxito');
    }

    /**
     * It deletes the book from the database
     *
     * @param Book book The route parameter name.
     *
     * @return The book is being deleted and the user is being redirected to the previous page with a
     * message.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('info', 'Libro eliminado con éxito');
    }
}
