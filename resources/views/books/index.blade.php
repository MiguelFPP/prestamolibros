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
            <a href="{{ route('books.create') }}" class="btn btn-success float-right">
                <i class="fas fa-plus"></i>
            </a>
            <h3 class="box-title">Lista de Categorias</h3>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulos</th>
                        <th>Autor</th>
                        <th>Edicion</th>
                        <th>Publicado</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name }}
                                @if ($book->author->deleted_at)
                                    <span class="badge badge-danger">Eliminado</span>
                                @endif
                            </td>
                            <td>{{ $book->edition }}</td>
                            <td>{{ $book->published_at }}</td>
                            <td>{{ $book->stock }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-2" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Titulos</th>
                        <th>Autor</th>
                        <th>Edicion</th>
                        <th>Publicado</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {!! $books->links() !!}
            </div>
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
