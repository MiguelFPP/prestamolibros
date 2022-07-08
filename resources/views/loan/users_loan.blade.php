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
            <a href="{{ route('loans.books_loan') }}" class="btn btn-success float-right">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Volver
            </a>
            <h3 class="box-title">Lista de Usuarios</h3>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            @if (session('books'))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Identificacion</th>
                            <th>Nombres</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->identification }}</td>
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $item)
                                        @if ($item->name == 'admin')
                                            <span class="badge badge-danger">Administrador</span>
                                        @elseif ($item->name == 'secretary')
                                            <span class="badge badge-success">Secretari@</span>
                                        @elseif ($item->name == 'client')
                                            <span class="badge badge-info">Cliente</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('loans.books_loan', $user) }}" class="btn btn-warning">
                                        <i class="fab fa-leanpub"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Identificacion</th>
                            <th>Nombres</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Error!</h4>
                    <p>No ha seleccionado los libros a prestar</p>
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
