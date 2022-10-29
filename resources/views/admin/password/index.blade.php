@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div>

</div>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success text-white">
    {{ session('info') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="box-title">Cambiar Contraseña</h3>
    </div>
    <div class="card-body">
        <form action="{{route('profile.update')}}" method="post">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col">
                        <x-adminlte-input name="identification" label="Contraseña Actual"
                            placeholder="Ingrese su contraseña actual" value="">
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
                        <x-adminlte-input name="name" label="Contraseña Nueva" placeholder="Ingrese su nueva contraseña"
                            value="">
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
                        <x-adminlte-input name="surname" label="Repita su contraseña" placeholder="Repita su nueva contraseña" value="">
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
