@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>

    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="box-title">Crear Nueva Categoria</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <x-adminlte-input name="name" label="Nombre" placeholder="Nombre de la categoria" value="{{ old('name') }}">
                        <x-slot name="prependSlot" class="@error('name') is-invalid @enderror">
                            <div class="input-group-text">
                                <i class="fas fa-list-ul text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Guardar</button>
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
