@extends('layout')
@section('title', "Usuario [n]")
@section('content-title',"Detalles del usuario [n]")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">

            <button class="btn btn-sm btn-outline-secondary">
                <span data-feather="lock"></span>
                Cambiar clave
            </button>
            <a class="btn btn-sm btn-outline-secondary" href="{{route('users')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" novalidate>
        <div class="row">
            <div class="col-4 mb-3">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" placeholder="Ingrese Nombre" value="{{$user->name}}" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>

                <label for="email">Correo Electrónico</label>
                <input type="text" class="form-control" name="email" placeholder="" value="{{$user->email}}" required>
            </div>
            <div class="col-4 mb-3">
                <button class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Actualizar
                </button>
            </div>
        </div>

    </form>
@endsection