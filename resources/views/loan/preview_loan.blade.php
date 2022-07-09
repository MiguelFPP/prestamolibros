@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div></div>
@stop

@section('content')
    {{-- table where list all auhtors --}}
    <div class="card">
        <div class="card-header">
            <a href="{{ route('loans.books_loan') }}" class="btn btn-success float-right">
                <i class="fas fa-book"></i>
                Seleccionar Libros
            </a>
            <h3 class="box-title">Prestamos para:
                <span class="text-primary">{{ $user->name }}</span>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            @if (session('books'))
                <form action="{{route('loans.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    {{-- input date --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_start">Fecha de Prestamo</label>
                                    <input type="date" name="date_start" id="date_start" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_end">Fecha de Devolucion</label>
                                    <input type="date" name="date_end" id="date_end" class="form-control"
                                        value="{{ date('Y-m-d', strtotime('+1 month')) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- button save --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Iniciar Prestamo
                        </button>
                    </div>
                </form>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Titulos</th>
                            <th>Autor</th>
                            <th>Cantidad</th>
                            <th>Stock</th>
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
