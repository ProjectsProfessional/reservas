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
            <a class="btn btn-sm btn-outline-secondary" href="{{route('tiposHabitaciones')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
@foreach($precios as $precio)
    <form class="needs-validation" method="POST" action="{{url("/precio/{$precio->ID_PRECIO}")}}">
	    {{ method_field('PUT') }}
	    {{csrf_field()}}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Código</label>
			 <select class="form-control" name="moneda" id="moneda">
				 <option name="moneda" value="{{ $precios->first()->ID_MONEDA }}">{{ $precios->first()->CODIGO }}</option>
				  @foreach($currencies as $currency)
					<option value="{{ $currency['ID_MONEDA'] }}" id="moneda"  name="moneda">{{ $currency['CODIGO'] }}</option>
				  @endforeach
			  </select>

            </div>
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
	           <input type="text" class="form-control" id="precio"  name="precio" value="{{$precio->PRECIO}}">
            </div>
	  </div>
	  <div class="row">
			 <div class="col-6 mb-3">
			     <label for="code">Impuesto</label>
				<select class="form-control" name="impuesto" id="impuesto">
					<option value="" name="impuesto">{{ $precios->first()->TASA }}</option>
					 @foreach($impuestos as $impuesto)
					    <option value="{{ $impuesto['ID_IMPUESTO'] }}" id="impuesto" name="impuesto">{{ $impuesto['TASA'] }}</option>
					 @endforeach
				 </select>
			 </div>

    		  <div class="col-6 mb-3">
    			 <label for="description">Personas</label>
    		    <input type="text" class="form-control" id="precio"  name="precio" value="{{$precio->PERSONAS}}">
    		  </div>
    	  </div>
	  <button class="btn btn-sm btn-outline-secondary">
		 <span data-feather="save"></span>
		 Actualizar
	  </button>
    </form>
 @endforeach
@endsection
