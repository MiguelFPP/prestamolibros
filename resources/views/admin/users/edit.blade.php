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
            <h3 class="box-title">Editar Usuario: {{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="post">
                @csrf
                @method('PUT')
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
                                value="{{ $user->name }}">
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
                                value="{{ $user->surname }}">
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

                    <div class="row">
                        <div class="form-group col">
                            <x-adminlte-select name="role" label="Rol" label-class="text-lightblue">
                                <x-slot name="prependSlot" class="@error('role') is-invalid @enderror">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-user-tag"></i>
                                    </div>
                                </x-slot>
                                <option value="" disabled selected>Seleccion el rol</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}" @if ($rol->name == $userRoles[0]) selected @endif>
                                        @if ($rol->name == 'admin')
                                            Administrador
                                        @elseif($rol->name == 'client')
                                            Cliente
                                        @elseif($rol->name == 'secretary')
                                            Secretari@
                                        @endif
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            @error('author_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
