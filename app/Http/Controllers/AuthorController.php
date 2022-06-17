<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::orderBy('id', 'desc')->paginate(5);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $request)
    {
        Author::create($request->all());

        return redirect()->route('authors.index')->with('info', 'Autor creado con éxito');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->all());

        return back()->with('info', 'Autor actualizado con éxito');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return back()->with('info', 'Autor eliminado con éxito');
    }
}
