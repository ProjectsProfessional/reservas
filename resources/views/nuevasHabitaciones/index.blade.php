@extends('layout')
@section('title', "Habitaciones")
@section('content-title',"Habitaciones")

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
	@if (session('fallo'))
	    <div class="alert alert-danger alert-dismissible fade show" role="alert">
	    {{ session('fallo') }}
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		 <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	@endif
    <h2>Resumen</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Tipo de habitaciones</th>
                <th>Estado de habitaciones</th>
                <th>Detalles</th>
	  		 <th>Detalles</th>
			 <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($habitaciones as $habitacion)
                <tr>
				 <td>{{$habitacion->ID_HABITACION}}</td>
                    <td> {{$habitacion->DESCRIPCION}}</td>
                    <td> {{$habitacion->ESTADO}}</td>
                    <td> {{$habitacion->DETALLES}}</td>
                    <td>
                        <a href="{{route('nuevasHabitaciones.details',[$habitacion->ID_HABITACION])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
				<td>
					{!! Form::open(['route'=>['nuevasHabitaciones.destroy', $habitacion->ID_HABITACION], 'method'=>'DELETE'])!!}
						{!! Form::submit('Eliminar', ['class'=>'btn btn-link']) !!}
					{!! Form::close() !!}
				</td>
                </tr>
            @empty
                <p>NO HAY HABITACIONES DEFINIDAS</p>
            @endforelse
		  {{ $habitaciones->links()}}
            </tbody>
        </table>
    </div>
@endsection
