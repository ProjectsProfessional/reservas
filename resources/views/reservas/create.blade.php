@extends('layout')
@section('title', $title)
@section('content-title',"Nueva reserva")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
    <link href="{{asset("css/autocomplete.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('reservas')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/reservas')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="code" name="code">
            </div>
            <div class="col-4 mb-3">
                <label for="description">Cliente</label>
				<!--<input type="text" class="form-control" id="cliente" name="cliente">-->

				<input type="text" name="country" id="autocomplete-ajax" class="form-control" style="position: absolute; z-index: 2; background: transparent;"/>
				<input type="text" name="country" id="autocomplete-ajax-x" class="form-control" disabled="disabled" style="color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
                <!--
                <input type="text" class="form-control" id="_country" name="_country" style="color: yellow" value="">
                -->
                <div id="selction-ajax" name="_country"></div>
            </div>

		  <div class="col-4 mb-3">
			 <label for="description">Fuente</label>
			 <select class="form-control" name="moneda" id="moneda" required>$fuentes
 		   		<option value="">--- Escoja la fuente ---</option>
 		   		@foreach($fuentes as $fuente)
 		   		   <option value="{{ $fuente['ID_FUNTE'] }}">{{$fuente['DESCRIPCION'] }}</option>
 		   		@endforeach
 		   	</select>
		  </div>
        </div>
	   <div class="row">
		  <div class="col-4 mb-3">
			 <label for="code">Fecha de ingreso</label>
			 <input type="date" class="form-control" id="code" name="fechaIngreso">
		  </div>
		  <div class="col-4 mb-3">
			 <label for="description">Fecha de retiro</label>
			 <input type="date" class="form-control" id="description" name="fechaSalida" >
		  </div>
	    <div class="col-4 mb-3">
		   <label for="description">Codigo de vuelo</label>
		   <input type="text" class="form-control" id="description" name="codigoVuelo	">
	    </div>
	   </div>
	   <hr>
	   <div class="row">
		  <div class="col-6">
			  <div class="table-responsive">
				  <h2>Disponibles</h2>
			    <table class="table table-striped table-sm">
				   <thead>
				   <tr>
					  <th>#</th>
					  <th>Descripcion</th>
					  <th>Carrito</th>
					  <th>Ver detalles</th>
				   </tr>
				   </thead>
				   <tbody>

				   @forelse($habitaciones as $habitacion)
					  <tr>
						 <td> {{ $habitacion->ID_HABITACION}}</td>
						 <td> {{$habitacion->DETALLES}}</td>
						 <td>
							<a href="">
							    <span data-feather="shopping-cart"></span>
							    Añadir
							</a>
						 </td>
						 <td>
							<a href="{{route('nuevasHabitaciones.details',[$habitacion->ID_ESTADO_HABITACION])}}">
							    <span data-feather="list"></span>
							    Ver detalles
							</a>
						 </td>
					  </tr>
				   @empty
					  <p>NO HAY ESTADOS DEFINIDOS</p>
				   @endforelse
				   </tbody>
			    </table>
			  </div>
		  </div>
		  <div class="col-6">
			  <h2>Agregadas</h2>
			  <div class="table-responsive">
			  	<table class="table table-striped table-sm">
			  	    <thead>
			  	    <tr>
			  	    <th>Habitacion</th>
			  	    </tr>
			  	    </thead>
			  	    <tbody>

			  	    @forelse($reservas as $reserva)
			  	    <tr>
			  	     <td> {{$reserva->DETALLES}}</td>
			  	    </tr>
			  	    @empty
			  	    <p>AUN NO HA AGREGADO HABITACIONES</p>
			  	    @endforelse
			  	    </tbody>
			  	</table>
			  </div>
		  </div>
	   </div>
        <div class="row">
		   <br><br>
            <div class="col-12"></div>
            <div class="col-6">
                <button class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Reservar ahora
                </button>
            </div>
        </div>
    </form>
    <br><br>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset("js/jquery.mockjax.js")}}"></script>
	<script type="text/javascript" src="{{asset("js/jquery.autocomplete.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/filters/test.js")}}"></script>
	<!--
	<script type="text/javascript" src="{{asset("js/filters/customers.js")}}"></script>
	-->
	<script>
        /*jslint  browser: true, white: true, plusplus: true */
        /*global $, countries */

        $(function () {
            'use strict';

            var countriesArray = $.map(@json($clientes), function (value, key) { return { value: value, data: key }; });

            // Setup jQuery ajax mock:
            $.mockjax({
                url: '*',
                responseTime: 2000,
                response: function (settings) {
                    var query = settings.data.query,
                        queryLowerCase = query.toLowerCase(),
                        re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi'),
                        suggestions = $.grep(countriesArray, function (country) {
                            // return country.value.toLowerCase().indexOf(queryLowerCase) === 0;
                            return re.test(country.value);
                        }),
                        response = {
                            query: query,
                            suggestions: suggestions
                        };

                    this.responseText = JSON.stringify(response);
                }
            });

            // Initialize ajax autocomplete:
            $('#autocomplete-ajax').autocomplete({
                // serviceUrl: '/autosuggest/service/url',
                lookup: countriesArray,
                lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                    var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                    return re.test(suggestion.value);
                },
                onSelect: function(suggestion) {
                    $('#selction-ajax').html(suggestion.data);
                    $('#id').val("asds");
                },
                onHint: function (hint) {
                    $('#autocomplete-ajax-x').val(hint);
                },
                onInvalidateSelection: function() {
                    $('#selction-ajax').html('You selected: none');
                }
            });

        });
	</script>
@endsection