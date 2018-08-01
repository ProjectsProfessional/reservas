@extends('layout')
@section('title', "ESTADOS")
@section('content-title',"ESTADOS")
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('estados.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nuevo
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
	                <th>Descripcion</th>
	                <th>Detalles</th>
				 <th>Acciones</th>
	            </tr>
            </thead>
            <tbody>
            @forelse($estados as $estado)
                <tr>
                    <td> {{$estado->ID_ESTADO_HABITACION}}</td>
                    <td> {{$estado->DESCRIPCION}}</td>
                    <td>
                        <a href="{{route('estados.details',[$estado->ID_ESTADO_HABITACION])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
				<td>
					{!! Form::open(['route'=>['estados.destroy', $estado->ID_ESTADO_HABITACION], 'method'=>'DELETE'])!!}
						{!! Form::submit('Eliminar', ['class'=>'btn btn-link']) !!}
					{!! Form::close() !!}
				</td>
                </tr>
            @empty
                <p>NO HAY ESTADOS DEFINIDOS</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
