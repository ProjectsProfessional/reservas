@extends('layout')
@section('title', $title)
@section('content-title',"Nueva reserva")
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
    <form class="needs-validation" method="POST" action="{{url('/currencies')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="code" name="code">
            </div>
            <div class="col-4 mb-3">
                <label for="description">Cliente</label>
                <select class="form-control" name="cliente" id="moneda" required>
 		   		<option value="">--- Escoja el cliente ---</option>
 		   		@foreach($clientes as $cliente)
 		   		   <option value="{{ $cliente['ID_CLIENTE'] }}">{{ $cliente['NOMBRE1']}} {{ $cliente['APELLIDO1']}} </option>
 		   		@endforeach
 		   	</select>
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
	   <div class="row">
		   <div class="table-responsive">
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
						 <a href="{{route('nuevasHabitaciones.details',[$habitacion->ID_ESTADO_HABITACION])}}">
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
	   <div class="row">
		   <div class="table-responsive">
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
						 <a href="{{route('nuevasHabitaciones.details',[$habitacion->ID_ESTADO_HABITACION])}}">
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
    <script type="text/javascript">
    	$('#myModal').modal(options)
    </script>
@endsection
