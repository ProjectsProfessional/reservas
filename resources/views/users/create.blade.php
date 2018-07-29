@extends('layout')
@section('title', "Crear Usuario")
@section('content-title',"Nuevo usuario")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('users')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/users')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-4 mb-3">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" placeholder="Ingrese Nombre" required>
            </div>
            <div class="col-4 mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="text" class="form-control" name="email" placeholder="" value="{{old('email')}}" required>
            </div>
            <div class="col-4 mb-3">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="123"  required>
            </div>
        </div>
        <button class="btn btn-sm btn-outline-secondary">
            <span data-feather="save"></span>
            Guardar
        </button>
    </form>
@endsection