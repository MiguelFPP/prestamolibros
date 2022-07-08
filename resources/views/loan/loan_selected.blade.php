@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div></div>
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
    {{-- table where list all auhtors --}}
    <div class="card">
        <div class="card-header">
            @if (session('books'))
                <a href="{{ route('loans.users_loan') }}" class="btn btn-success float-right">
                    <i class="fas fa-user"></i>
                    Seleccionar Usuario
                </a>
            @endif
            <h3 class="box-title">Informacion de Seleccion</h3>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            @if (session('books'))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Titulos</th>
                            <th>Autor</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author->name }}</td>
                                <td lass="d-flex justify-content-center">
                                    <form action="{{ route('loans.remove_book', $book) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        <button class="btn btn-warning mx-2" type="submit"
                                            @if (array_search($book->id, array_column(session('books'), 'id')) === false) disabled @endif>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </form>
                                    <span>
                                        @if (array_search($book->id, array_column(session('books'), 'id')) !== false)
                                            <span class="badge badge-success">
                                                {{ session('books')[$book->id]['quantity'] }}
                                            </span>
                                        @else
                                            <span class="badge badge-primary">0</span>
                                        @endif
                                    </span>
                                    <form action="{{ route('loans.add_book', $book) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        <button class="btn btn-warning mx-2" type="submit"
                                            @if (array_search($book->id, array_column(session('books'), 'id')) !== false) {{ session('books')[$book->id]['quantity'] == $book->stock ? 'disabled' : '' }} @endif>
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $book->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- button clean --}}
                <div class="mt-2">
                    <a href="{{ route('loans.clean_loan') }}" class="btn btn-danger float-right">
                        <i class="fas fa-trash"></i>
                        Limpiar
                    </a>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    <strong>No hay libros seleccionados</strong>
                </div>
            @endif
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
