@extends('layout')
@section('title', $title)
@section('content-title',"Usuarios")
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('users.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nuevo usuario
            </a>
        </div>
    </div>
@endsection
@section('content')
    <h2>Resumen</h2>
    @isset($message)
        <div class="alert alert-primary" role="alert">
            {{$message}}
        </div>
    @endisset
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Detalles</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{route('users.details',[$user->id])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
                    <td>
                        {!! Form::open(['route'=>['user.destroy', $user->id], 'method'=>'DELETE'])!!}
                        {!! Form::submit('Eliminar', ['class'=>'btn btn-link'],['data-feather'=>'delete']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <p>NO HAY USUARIOS REGISTRADOS</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
