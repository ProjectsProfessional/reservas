@extends('layout')
@section('title', $title)
@section('content-title',"Tipos de habitaciones")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('tiposHabitaciones.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nuevo tipo de habitacion
            </a>
        </div>
    </div>
@endsection
@section('content')
    <h2>Resumen</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
		   @if (session('fallo'))
			  <div class="alert alert-danger alert-dismissible fade show" role="alert">
			  {{ session('fallo') }}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		   @endif
            <thead>
	            <tr>
	                <th>#</th>
	                <th>Descripcion</th>
	                <th>Numero de personas</th>
				 <th>Detalles</th>
				 <th>Acciones</th>
	            </tr>
            </thead>
            <tbody>

            @foreach($tipos as $tipo)
                <tr>
                    <td> {{$tipo->ID_TIPO_HABITACION}}</td>
                    <td> {{$tipo->DESCRIPCION}}</td>
                    <td> {{$tipo->PERSONAS}}</td>
                    <td>
                        <a href="{{route('tiposHabitaciones.details',[$tipo->ID_TIPO_HABITACION])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
				<td>
					{!! Form::open(['route'=>['tiposHabitaciones.destroy', $tipo->ID_TIPO_HABITACION], 'method'=>'DELETE'])!!}
						{!! Form::submit('Eliminar', ['class'=>'btn btn-link']) !!}
					{!! Form::close() !!}
				</td>
                </tr>
			 @endforeach
			{{ $tipos->links() }}
            </tbody>
        </table>
    </div>
@endsection
