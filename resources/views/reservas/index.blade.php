@extends('layout')
@section('title', "Reservas")
@section('content-title',"Reservas")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('reservas.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nueva Reserva
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
                <th>Código</th>
			 <th>Cliente</th>
			 <th># Personas</th>
			 <th>Estado</th>
			 <th>Fecha de ingreso</th>
			 <th>Fecha de retiro</th>
                <th>Codigo de vuelo</th>
			 <th>Detalles</th>
			 <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @forelse($reservas as $reserva)
                <tr>
                <td> {{$reserva->ID_RESERVA}}</td>
                <td> {{$reserva->CODIGO}}</td>
                <td> {{$reserva->NOMBRE}} {{$reserva->APELLIDO}}</td>
				<td> {{$reserva->PERSONAS}}</td>
				<td> {{$reserva->ESTADO}}</td>
				<td> {{$reserva->FECHA_INGRESO}}</td>
				<td> {{$reserva->FECHA_RETIRO}}</td>
				<td> {{$reserva->CODIGO_VUELO}}</td>
                    <td>
                        <a href="{{route('reservas.details',[$reserva->ID_RESERVA])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
				<td>
					{!! Form::open(['route'=>['reservas.destroy', $reserva->ID_RESERVA], 'method'=>'DELETE'])!!}
						{!! Form::submit('Eliminar', ['class'=>'btn btn-link']) !!}
					{!! Form::close() !!}
				</td>
                </tr>
            @empty
                <p>NO EXISTEN RESERVAS</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
