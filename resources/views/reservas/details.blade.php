@extends('layout')
@section('title', "Detalles de la reserva ".$reserva->CODIGO)
@section('content-title',"Detalles de la reserva ".$reserva->CODIGO)
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
    <link href="{{asset("css/autocomplete.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('reservas')}}">
                <span data-feather="arrow-left-circle"></span>
                Regresar
            </a>
        </div>
    </div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-2 mb-3">
            <label for="code">Código</label>
            <input type="text" class="form-control" id="code" name="code" value="{{$reserva->CODIGO}}" readonly="true" required>
        </div>

        <div class="col-4 mb-3">
            <label for="description">Cliente</label>
            <input type="text" class="form-control on-back" id="cliente" name="cliente" value="{{$reserva->customer->NOMBRE1.' '. $reserva->customer->APELLIDO1}}"  readonly="true"required>
        </div>

        <div class="col-3 mb-3">
            <label for="description">Fuente</label>
            <input type="text" class="form-control" id="fuente" name="fuente" value="{{$reserva->source->CODIGO}}" readonly="true"required>
        </div>

        <div class="col-3 mb-3">
            <label for="personas">Personas</label>
            <input type="number" class="form-control" id="personas" name="personas" value="{{$reserva->PERSONAS}}" readonly="true" required>
        </div>
    </div>
    <div class="row">
        <div class="col-4 mb-3">
            <label for="code">Fecha de ingreso</label>
            <input type="date" disabled class="form-control" id="fechaIngreso" name="fechaIngreso" value="{{$reserva->FECHA_INGRESO}}" required>
        </div>
        <div class="col-4 mb-3">
            <label for="description">Fecha de retiro</label>
            <input type="date" disabled class="form-control" id="fechaSalida" name="fechaSalida"value="{{$reserva->FECHA_RETIRO}}" required>
        </div>
        <div class="col-4 mb-3">
            <label for="description">Codigo de vuelo</label>
            <input type="text" class="form-control" id="codigoVuelo" name="codigoVuelo"value="{{$reserva->CODIGO_VUELO}}" readonly="true">
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            <h3>Habitaciones Asignadas</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm habitaciones">
                    <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Tipo De Habitación</th>
                        <th>Detalles</th>
                        <th>Moneda</th>
                        <th>precio</th>
                    </tr>
                    </thead>
                    <tr>
                        @foreach($habitaciones as $habitacion)
                            <td>{{$habitacion->ID_HABITACION}}</td>
                            <td>{{$habitacion->room->type->DESCRIPCION}}</td>
                            <td>{{$habitacion->room->DETALLES}}</td>
                            <td>{{$habitacion->currency->CODIGO}}</td>
                            <td>{{$habitacion->PRECIO}}</td>
                        @endforeach
                    </tr>
                    <tbody>
                    </tbody>
                    <tfoot id="foot">
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
