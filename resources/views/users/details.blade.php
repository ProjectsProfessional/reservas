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

    <form class="needs-validation" method="POST" action="{{url('/users')}}">
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
        /*
        $("#submit").click(function() {
            var newPassword = $('#newPassword').val();
            var verifyPassword = $('#verifyPassword').val();
            if(newPassword !=verifyPassword){
                alert("la Nueva clave no coincide, Por  favor corrija los campos.");
                password = $('#password').val("");
                newPassword = $('#newPassword').val("");
                verifyPassword = $('#verifyPassword').val("");
            }
        });
        /*
        $("#changePass").click(function() {
            var password = $('#password').val();
            var newPassword = $('#newPassword').val();
            var verifyPassword = $('#verifyPassword').val();

            if(newPassword ==verifyPassword){
             let data= {
                 _token: "{{ csrf_token() }}",
                 user: "{{$user->id}}",
                 email: "{{$user->email}}",
                 password: password,
                 newPassword: newPassword
             };

             $.ajax({
                 url: "{{ route('user.password') }}",
                 method: 'post',
                 data: data,
                 success: function(result){
                     alert(result.message);
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     //alert('Lo Sentimos, no ha sido posible crear el tipo de habitación.');
                     alert(jqXHR.responseText);
                 }
             });
            }else{
                alert("la Nueva clave no coincide, Por  favor corrija los campos.");
                password = $('#password').val("");
                newPassword = $('#newPassword').val("");
                verifyPassword = $('#verifyPassword').val("");
            }*/

    </script>
@endsection