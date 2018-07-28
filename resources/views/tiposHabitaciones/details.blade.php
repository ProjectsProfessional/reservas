@extends('layout')
@section('title', "Detalles de la habitacion")
@section('content-title',"Detalles de la habitacion")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('tiposHabitaciones')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
@foreach ($habitaciones as $habitacion)
    <form class="needs-validation" method="POST" action="{{url("/tiposHabitaciones/{$habitacion->ID_TIPO_HABITACION}")}}">
	    {{ method_field('PUT') }}
	    {{csrf_field()}}

        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Descripcion</label>
                <input type="text" class="form-control" id="firstName" name="description" value="{{$habitacion->DESCRIPCION}}">
            </div>
            <div class="col-6 mb-3">
                <label for="description">Personas</label>
                <input type="text" class="form-control" id="lastName"  name="personas" value="{{$habitacion->PERSONAS}}">
            </div>
        </div>
	   <div class="row">
		   <h3>Precios asignados</h3>
		  <div class="col-6 mb-3">
			 <label for="code">Descripcion</label>
			 <input type="text" class="form-control" id="firstName" name="description" value="{{$habitacion->DESCRIPCION}}">
		  </div>
		  <div class="col-6 mb-3">
			 <label for="description">Personas</label>
			 <input type="text" class="form-control" id="lastName"  name="personas" value="{{$habitacion->PERSONAS}}">
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
