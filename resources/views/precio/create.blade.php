@extends('layout')
@section('title', $title)
@section('content-title',"Nuevo Precio")
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
    <form class="needs-validation" method="POST" action="{{url('/precio')}}">
        <div class="row">
		   {{csrf_field()}}
		   <div class="col-4 mb-3">
		   	<label for="description">Moneda</label>
		   	<select class="form-control" name="moneda" id="moneda" required>
		   		<option value="">--- Escoja la moneda ---</option>
		   		@foreach($currencies as $currency)
		   		   <option value="{{ $currency['ID_MONEDA'] }}">{{ $currency['DESCRIPCION'] }}</option>
		   		@endforeach
		   	</select>
		   </div>
            <div class="col-6 mb-3">
                <label for="description">Precio</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12"></div>
            <div class="col-6">
                <button class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Guardar
                </button>
            </div>
        </div>
    </form>
@endsection
