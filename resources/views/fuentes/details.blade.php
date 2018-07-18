@extends('layout')
@section('title', "Detalles de las fuentes de reserva")
@section('content-title',"Detalles de las fuentes de reserva ". $fuente->DESCRIPCION)
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('fuentes')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url("/fuentes/{$fuente->ID_FUENTE}")}}">
	    {{ method_field('PUT') }}
	    {{csrf_field()}}
       <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="firstName" name="code"  value="{{$fuente->CODIGO}}" readonly>
            </div>
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="lastName" name="description"  value="{{$fuente->DESCRIPCION}}">
            </div>
	  </div>
	  <div class="row">
		  <div class="col-4 mb-3">
			  <button class="btn btn-sm btn-outline-secondary">
				 <span data-feather="save"></span>
				 Actualizar
			  </button>
		  </div>
	  </div>
    </form>
@endsection
