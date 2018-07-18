@extends('layout')
@section('title', $title)
@section('content-title',"Nueva habitacion")
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
    <form class="needs-validation" method="POST" action="{{url('/nuevasHabitaciones')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Tipo de habitacion</label>
			 <select class="form-control" name="tipo" id="moneda" required>
			 	<option value="">--- Escoja el tipo ---</option>
			 	@foreach($habitaciones as $habitacion)
			 	   <option value="{{ $habitacion['ID_TIPO_HABITACION'] }}">{{ $habitacion['DESCRIPCION'] }}</option>
			 	@endforeach
			 </select>
            </div>
		  <div class="col-6 mb-3">
			 <label for="code">Estado</label>
		    <select class="form-control" name="estado" id="moneda" required>
			   <option value="">--- Estado de la habitacion ---</option>
			   @foreach($tipos as $tipo)
				 <option value="{{ $tipo['ID_ESTADO_HABITACION'] }}">{{ $tipo['DESCRIPCION'] }}</option>
			   @endforeach
		    </select>
		  </div>
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <button class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Guardar
                </button>
            </div>
        </div>
    </form>
@endsection
