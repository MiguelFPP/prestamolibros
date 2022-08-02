@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div></div>
@stop

@section('content')
    {{-- table where list all auhtors --}}
    <div class="card">
        <div class="card-header">
            <a href="{{ route('history_loan.index') }}" class="btn btn-success float-right">
                <i class="fas fa-loan"></i>
                Volver
            </a>
            <h3 class="box-title">Prestamo de:
                <span class="text-primary">{{ $loan->user->name }}</span>
            </h3>
            <p>
                Identificacion:
                <span class="text-primary">
                    {{ $loan->user->identification }}
                </span>
            </p>
            <p>
                Correo:
                <span class="text-primary">
                    {{ $loan->user->email }}
                </span>
            </p>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>
                            <p>Fecha inicio: </p>
                            <span class="text-primary">
                                {{ $loan->date_start->toFormattedDateString() }}
                            </span>
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <h5>
                            <p>Fecha fin: </p>
                            <span class="text-primary">
                                {{ $loan->date_end->toFormattedDateString() }}
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->book->title }}</td>
                            <td>{{ $book->book->author->name }}</td>
                            <td>{{ $book->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay Libros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
