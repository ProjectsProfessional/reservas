@extends('layout')
@section('title', "Actualizar impuestos")
@section('content-title',"Actualizar de los impuestos")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">

            <a class="btn btn-sm btn-outline-secondary" href="{{route('impuestos')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" novalidate>
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="firstName"  value="{{$impuesto->CODIGO}}">
            </div>
            <div class="col-6 mb-3">
                <label for="tasa">Tasa</label>
                <input type="text" class="form-control" id="lastName"  value="{{$impuesto->TASA}}">
            </div>
        </div>
	   <button class="btn btn-sm btn-outline-secondary">
		  <span data-feather="save"></span>
		  Actualizar
	   </button>
    </form>
@endsection
