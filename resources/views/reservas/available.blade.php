@extends('layout')
@section('title', "Disponibilidad")
@section('content-title',"Disponibilidad de habitaciones")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <form class="needs-validation" method="POST" action="{{route('reservas.rooms.available')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="from">Fecha de ingreso</label>
                    <input type="date" class="form-control" id="from" name="from" required>
                </div>

                <div class="col-4 mb-3">
                    <label for="from">Fecha de ingreso</label>
                    <input type="date" class="form-control" id="to" name="to" required>
                </div>

                <div class="col-4 mb-3">
                    <label for="from">Habitaciones</label>
                    <select class="form-control" name="filter" id="filter" required>
                        <option value="available">Disponibles</option>
                        <option value="unavailable">Reservadas</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-sm btn-outline-secondary">
                <span data-feather="search"></span>
                Buscar
            </button>
        </form>
    </div>
@endsection
@section('content')
    @isset($habitaciones)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{$title}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @if($filter == 'available')
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Habitacion</th>
                        <th>Tipo Habitacion</th>
                        <th>Descripcion</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($habitaciones as $habitacion)
                            <tr>
                                <td>{{$habitacion->HABITACION}}</td>
                                <td>{{$habitacion->TIPO_HAB}}</td>
                                <td>{{$habitacion->DESCRIPCION}}</td>
                            </tr>
                        @empty
                            <p><strong> No Se encuentran habitaciones disponibles</strong></p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Codigo De Reserva </th>
                        <th>Personas</th>
                        <th>HABITACION</th>
                        <th>Moneda</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($habitaciones as $habitacion)
                        <tr>
                            <td>{{$habitacion->CODIGO}}</td>
                            <td>{{$habitacion->PERSONAS}}</td>
                            <td>{{$habitacion->DETALLES}}</td>
                            <td>{{$habitacion->MONEDA}}</td>
                            <td>{{$habitacion->PRECIO}}</td>
                        </tr>
                    @empty
                        <p><strong> No Se encuentran habitaciones disponibles</strong></p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    @endisset
@endsection