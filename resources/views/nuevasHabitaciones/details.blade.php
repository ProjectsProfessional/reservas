@extends('layout')
@section('title', "Detalles de las habitaciones")
@section('content-title',"Detalles de las habitaciones")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('nuevasHabitaciones')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
@foreach($habitaciones as $habitacion)
    <form class="needs-validation" method="POST" action="{{url("/nuevasHabitaciones/{$habitacion->ID_HABITACION}")}}">
	    {{ method_field('PUT') }}
	    {{csrf_field()}}
	    @if (session('fallo'))
		   <div class="alert alert-danger alert-dismissible fade show" role="alert">
		   {{ session('fallo') }}
		   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		   </button>
		 </div>
	    @endif
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Tipo de habitacion</label>
			 <select class="form-control" name="tipo" id="tipo">
				 <option name="tipo" value="{{ $habitaciones->first()->ID_TIPO_HABITACION }}">{{$habitacion->DESCRIPCION}}</option>
				  @foreach($tipos as $tipo)
					<option value="{{ $tipo['ID_TIPO_HABITACION'] }}" id="tipo"  name="tipo">{{ $tipo['DESCRIPCION'] }}</option>
				  @endforeach
			  </select>
            </div>
            <div class="col-6 mb-3">
                <label for="description">Estado</label>
			 <select class="form-control" name="estado" id="estado">
				 <option name="estado" value="{{ $habitaciones->first()->ID_ESTADO_HABITACION}}">{{$habitacion->ESTADO}}</option>
				  @foreach($estados as $estado)
					<option value="{{ $estado['ID_ESTADO_HABITACION'] }}" id="estado"  name="estado">{{ $estado['DESCRIPCION'] }}</option>
				  @endforeach
			  </select>
            </div>
		  <div class="col-6 mb-3">
                <label for="description">Detalles</label>
                <input type="text" class="form-control"  name="description" value="{{$habitacion->DETALLES}}">
            </div>
        </div>
	   <div class="row">
            <div class="col-12"></div>
            <div class="col-6">
                <button class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Actualizar
                </button>
            </div>
        </div>
    </form>
@endforeach
@endsection
