<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryLoanController extends Controller
{
    public function index()
    {
        $loans=Loan::with('user')->with('book_loans')->paginate(6);

        /* A function that is used to iterate over the collection and perform the given callback on
        each item. */
        $loans->each(function($loan){
            $loan->quantity=$loan->book_loans->sum('quantity');
        });
        return view('history_loan.index', compact('loans'));
    }

    public function show($id)
    {
        $loan=Loan::with('user')->with('book_loans')->find($id);
        /* $loan->quantity=$loan->book_loans->sum('quantity'); */
        return view('history_loan.show', compact('loan'));
    }
}
