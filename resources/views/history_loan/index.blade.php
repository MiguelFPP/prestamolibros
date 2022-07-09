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
            <h3 class="box-title">Seguimiento Prestamos</h3>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Identificacion</th>
                        <th>Cantidad</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->id }}</td>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->user->identification }}</td>
                            <td>{{ $loan->quantity }}</td>
                            <td>{{ $loan->date_start }}</td>
                            <td>{{ $loan->date_end }}</td>
                            <td>
                                @if ($loan->status == 0)
                                    <span class="badge badge-warning">Activo</span>
                                @elseif($loan->status == 1)
                                    <span class="badge badge-success">Entregado</span>
                                @else
                                    <span class="badge badge-danger">Multa</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href="{{route('history_loan.show', $loan)}}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{-- {{ route('history_loan.destroy', $loan->id) }} --}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Identificacion</th>
                        <th>Cantidad</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {!! $loans->links() !!}
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
