@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div>

</div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="box-title">Editar Perfil: {{$user->name}} {{$user->surname}}</h3>
    </div>
    <div class="card-body">
        <form action="" method="post">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col">
                        <x-adminlte-input name="identification" label="Identificacion"
                            placeholder="Identificacion del usuario" value="{{ $user->identification }}">
                            <x-slot name="prependSlot" class="@error('identification') is-invalid @enderror">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-id-card"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        @error('identification')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <x-adminlte-input name="name" label="Nombre" placeholder="Nombre del usuario"
                            value="{{$user->name}}">
                            <x-slot name="prependSlot" class="@error('name') is-invalid @enderror">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-signature"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <x-adminlte-input name="surname" label="Apellido" placeholder="Apellido del usuario"
                            value="{{$user->surname}}">
                            <x-slot name="prependSlot" class="@error('surname') is-invalid @enderror">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-signature"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <x-adminlte-input name="email" label="Email" placeholder="Email del Usuario"
                            value="{{ $user->email }}">
                            <x-slot name="prependSlot" class="@error('email') is-invalid @enderror">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-at"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        @error('email')
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
