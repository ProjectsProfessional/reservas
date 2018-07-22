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
{{csrf_field()}}
	   <div class="row">

		   <div class="row">
		       <div class="col-6 mb-3">
		   	   <label for="currencies">Moneda</label>
		   	   <select class="form-control" name="moneda" required>
		   	    <option value="">--- Escoja la moneda ---</option>
		   	    @foreach($currencies as $currency)
		   		  <option value="{{ $currency['ID_MONEDA'] }}">{{ $currency['DESCRIPCION'] }}</option>
		   	    @endforeach
		       </select>
		       </div>

		       <div class="col-6 mb-3">
		   	   <label for="tax">Impuesto</label>
		   	   <select class="form-control" name="impuesto" required>
		   	    <option value="">--- Escoja el impuesto ---</option>
		   	    @foreach($impuestos as $impuesto)
		   		  <option value="{{ $impuesto['ID_IMPUESTO'] }}">{{ $impuesto['TASA'] }}</option>
		   	    @endforeach
		   	   </select>
		       </div>
		   </div>
		   <div class="row">
		       <div class="col-6 mb-3">
		   	   <label for="grossTotal">Precio Bruto</label>
		   	   <select class="form-control" name="grossTotal" required>
		   		  <option value="1">Si</option>
		   		  <option value="0">No</option>
		   	   </select>
		       </div>
		       <div class="col-6 mb-3">
		   	   <label for="price">Precio</label>
		   	   <input type="number" class="form-control" id="price" name="price" required>
		       </div>
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
