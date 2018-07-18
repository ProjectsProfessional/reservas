@extends('layout')
@section('title', "Detalles de Moneda")
@section('content-title',"Detalles del precio")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('precio')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url("/precio/{$precio->ID_PRECIO}")}}">
	    {{ method_field('PUT') }}
	    {{csrf_field()}}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="firstName" name="code"  value="{{$precio->ID_MONEDA}}" readonly>
            </div>
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="lastName"  name="precio" value="{{$precio->PRECIO}}">
            </div>
	  </div>
	  <button class="btn btn-sm btn-outline-secondary">
		 <span data-feather="save"></span>
		 Actualizar
	  </button>
    </form>
@endsection
