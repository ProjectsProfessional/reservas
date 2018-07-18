@extends('layout')
@section('title', "habitaciones")
@section('content-title',"habitaciones")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('nuevasHabitaciones.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nueva habitaciones
            </a>
        </div>
    </div>
@endsection
@section('content')
    <h2>ResUmen</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Tipo de habitaciones</th>
                <th>Estado de habitaciones</th>
                <th>Detalles</th>
            </tr>
            </thead>
            <tbody>
            @forelse($habitaciones as $habitacion)
                <tr>
				 <td>{{$habitacion->ID_HABITACION}}</td>
                    <td> {{$habitacion->ID_TIPO_HABITACION}}</td>
                    <td> {{$habitacion->ID_ESTADO_HABITACION}}</td>
                    <td> {{$habitacion->DETALLES}}</td>
                    <td>
                        <a href="{{route('nuevasHabitaciones.details',[$habitacion->ID_HABITACION])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
                </tr>
            @empty
                <p>NO HAY HABITACIONES DEFINIDAS</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
