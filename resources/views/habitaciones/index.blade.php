@extends('layout')
@section('title', "Areas")
@section('content-title',"Areas")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('tipoHabitacion.create')}}">
                <span data-feather="arrow-up-circle"></span>
               Nueva Habitación
            </a>
        </div>
    </div>
@endsection
@section('content')
    <h2>Resumen</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>código</th>
                <th>Area/Departamento</th>
                <th>Detalles</th>
			 <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($areas as $areas)
                    <tr>
                        <td>{{$areas->ID_AREAS}}</td>
                        <td>{{$areas->CODIGO}}</td>
                        <td>{{$areas->DESCRIPCION}}</td>
                        <td>
                            <a href="{{route('areas.details',[$areas->ID_AREAS])}}">
                                <span data-feather="edit"></span>
                                Ver Detalles
                            </a>
                        </td>
                    </tr>
                @empty
                    <p>NO HAY AREAS REGISTRADOS</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
