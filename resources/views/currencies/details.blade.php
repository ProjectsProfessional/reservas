@extends('layout')
@section('title', "Detalles de Moneda")
@section('content-title',"Detalles de la moneda". $currency->CODIGO_MONEDA)
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('currencies')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url("/currencies/{$currency->ID_MONEDA}")}}">
	    {{ method_field('PUT') }}
	    {{csrf_field()}}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="firstName" name="code" value="{{$currency->CODIGO}}">
            </div>
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="lastName"  name="description" value="{{$currency->DESCRIPCION}}">
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
@endsection
