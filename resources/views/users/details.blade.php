@extends('layout')
@section('title', "Usuario: ". $user->id)
@section('content-title',"Detalles del usuario: ".$user->name)
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">

            <button id="changePass" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModalLong">
                <span data-feather="lock"></span>
                Cambiar clave
            </button>
            @include('modals.users.changePassword')
            <a class="btn btn-sm btn-outline-secondary" href="{{route('users')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    @isset($error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endisset

    <form class="needs-validation" method="POST" action="{{url("/users/{$user->id}")}}">
        {{ method_field('PUT') }}
        {{csrf_field()}}
        <div class="row">
            <div class="col-4 mb-3">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" placeholder="Ingrese Nombre" value="{{$user->name}}"required>
            </div>
            <div class="col-4 mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="text" class="form-control" name="email" placeholder="" value="{{$user->email}}" required>
            </div>
        </div>

        <button class="btn btn-lg btn-outline-primary">
            <span data-feather="save"></span>
            Actualizar
        </button>
    </form>
@endsection

@section('scripts')
    <script>
        $("#changePass").click(function() {
            $('#saveEmail').val("{{$user->email}}");
        });
    </script>
@endsection