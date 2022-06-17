@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>

    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                {{ session('info') }}
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="box-title">Editar Libro: {{ $book->title }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('books.update', $book) }}" method="post">
                @csrf
                @method('PUT')
                <div class="container">
                    <div class="row">
                        <div class="form-group col">
                            <x-adminlte-input name="title" label="Titulo" placeholder="Titulo del Libro"
                                value="{{ $book->title }}">
                                <x-slot name="prependSlot" class="@error('title') is-invalid @enderror">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <x-adminlte-input name="edition" label="Edicion" placeholder="Edicio del Libro"
                                value="{{ $book->edition }}">
                                <x-slot name="prependSlot" class="@error('edition') is-invalid @enderror">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('edition')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <x-adminlte-input name="stock" label="Stock" placeholder="Cantidad de Libros en Inventario"
                                type="number" min=1 value="{{ $book->stock }}">
                                <x-slot name="prependSlot" class="@error('stock') is-invalid @enderror">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-hashtag"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <x-adminlte-select name="author_id" label="Autor" label-class="text-lightblue">
                                <x-slot name="prependSlot" class="@error('author_id') is-invalid @enderror">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                </x-slot>
                                <option value="" disabled selected>Seleccion el Autor</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" @if ($author->id == $book->author->id) selected @endif>
                                        {{ $author->name }}</option>
                                @endforeach
                            </x-adminlte-select>
                            @error('author_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="published_at">Fecha de Publicacion</label>
                        <input type="date" class="form-control @error('published_at') is-invalid @enderror"
                            name="published_at" id="published_at" value="{{ $book->published_at }}">
                        @error('published_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{-- make a list of checkbox with the categories --}}
                        <label for="categories">Categorias</label>
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                            value="{{ $category->id }}" id="{{ $category->name }}"
                                            @if ($book->categories->contains($category)) checked @endif>
                                        <label class="form-check-label" for="{{ $category->name }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            @error('categories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
