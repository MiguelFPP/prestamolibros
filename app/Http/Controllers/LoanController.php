<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use App\Events\LoanBooksEndEvent;
use App\Http\Requests\LoanRequest;
use App\Events\LoanBooksStartEvent;

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

    /**
     * It removes the books session variable
     *
     * @return the view of the books_loan.blade.php
     */
    public function cleanBooks()
    {
        session()->forget('books');
        return redirect()->route('loans.books_loan');
    }

    /**
     * It gets the books from the session and returns them to the view
     *
     * @return The view loan_selected.blade.php
     */
    public function showLoanSelected()
    {
        $books_cart = session()->get('books');
        $books = Book::whereIn('id', array_keys($books_cart))->get();
        return view('loan.loan_selected', compact('books_cart', 'books'));
    }

    /**
     * It creates a loan, then creates a book loan for each book in the cart
     *
     * @param LoanRequest request The request object.
     *
     * @return It is being returned the view of the loan history.
     */
    public function loanStore(LoanRequest $request)
    {
        $books_cart = session()->get('books');
        $books = Book::whereIn('id', array_keys($books_cart))->get();
        $user = User::find($request->user_id);
        /* Creating a new loan with the data from the request. */
        $loan = Loan::create([
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status' => '0',
            'user_id' => $user->id
        ]);
        /* Creating a book loan for each book in the cart. */
        foreach ($books as $book) {
            BookLoan::create([
                'loan_id' => $loan->id,
                'book_id' => $book->id,
                'quantity' => $books_cart[$book->id]['quantity']
            ]);
        }
        /* discount stock */
        foreach ($books as $book) {
            $book->stock = $book->stock - $books_cart[$book->id]['quantity'];
            $book->save();
        }

        event(new LoanBooksStartEvent($books, $user, $request->date_end));

        session()->forget('books');
        return redirect()->route('history_loan.index')->with('success', 'Prestamo Iniciado');
    }

    /**
     * It takes a user object as a parameter and returns a view with the books_cart, books and user
     * variables
     *
     * @param User user The user that is currently logged in.
     *
     * @return The view loan.preview_loan is being returned.
     */
    public function previewLoan(User $user)
    {
        $books_cart = session()->get('books');
        $books = Book::whereIn('id', array_keys($books_cart))->get();
        return view('loan.preview_loan', compact('books_cart', 'books', 'user'));
    }

    public function loanEnd(Loan $loan)
    {
        if ($loan->date_end > now()) {
            $loan->status = '2';
            $loan->save();
        } else {
            $loan->status = '1';
            $loan->save();
        }
        $books = BookLoan::where('loan_id', $loan->id)->get();
        foreach ($books as $book) {
            $book->book->stock = $book->book->stock + $book->quantity;
            $book->book->save();
        }
        event(new LoanBooksEndEvent($loan->user, $loan->date_start, $loan->date_end));
        return redirect()->route('history_loan.index')->with('success', 'Prestamo Finalizado');
    }
}
