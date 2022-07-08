<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * It gets all the users that are not admins and paginates them
     *
     * @return A view with the users and their roles.
     */
    public function usersLoan()
    {
        $users = User::select('id', 'name', 'email', 'identification')
            ->with('roles:name')
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('loan.users_loan', compact('users'));
    }

    /**
     * It gets the books from the database and if there's a session with books, it gets the session and
     * encodes it to json
     *
     * @return A view with the name of books_loan.blade.php
     */
    public function booksLoan()
    {
        /* if (session()->has('books')) {
            $booksSession = json_encode(session()->get('books'));
        } */
        $books = Book::orderBy('id', 'desc')->paginate(6);
        return view('loan.books_loan', compact('books'));
    }

    /**
     * It adds a book to the cart
     *
     * @param id The id of the book to be added to the cart.
     *
     * @return The user is being returned to the previous page.
     */
    public function addBook($id)
    {
        $book = Book::find($id);
        if (!session()->has('books')) {
            session()->put('books', []);
        }
        $books = session()->get('books');
        if (array_key_exists($id, $books)) {
            if ($books[$id]['quantity'] != $book->stock) {
                $books[$id]['quantity']++;
            }
        } else {
            $books[$id] = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'quantity' => 1
            ];
        }
        session()->put('books', $books);
        return back();
    }

    /**
     * It removes a book from the cart
     *
     * @param id The id of the book to be removed from the cart.
     *
     * @return The user is being returned to the previous page.
     */
    public function removeBook($id)
    {
        $books = session()->get('books');
        if (array_key_exists($id, $books)) {
            if ($books[$id]['quantity'] > 1) {
                $books[$id]['quantity']--;
            } else {
                unset($books[$id]);
            }
        }
        session()->put('books', $books);
        return back();
    }

    public function cleanBooks()
    {
        session()->forget('books');
        return redirect()->route('loans.books_loan');
    }

    public function showLoanSelected()
    {
        $books_cart = session()->get('books');
        $books = Book::whereIn('id', array_keys($books_cart))->get();
        return view('loan.loan_selected', compact('books_cart', 'books'));
    }

    /**
     * It saves the loan in the database
     *
     * @param Request $request The request with the data of the loan.
     *
     * @return The user is being redirected to the previous page.
     */
    /* public function saveLoan(Request $request)
    {
        $books = session()->get('books');
        $loan = new Loan();
        $loan->user_id = $request->user_id;
        $loan->save();
        foreach ($books as $book) {
            $loan->books()->attach($book['id'], ['quantity' => $book['quantity']]);
        }
        session()->forget('books');
        return back();
    } */
}
