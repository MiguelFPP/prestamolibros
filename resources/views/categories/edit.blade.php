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
            <h3 class="box-title">Editar Categoria {{ $category->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <x-adminlte-input name="name" label="Nombre" placeholder="Nombre de la Categoria"
                        value="{{ $category->name }}">
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
