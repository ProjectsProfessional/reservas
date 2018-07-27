@extends('layout')
@section('title', $title)
@extends('reservas)
@section('list')
    <div class="table-responsive">
	    <table class="table table-striped table-sm">
	        <thead>
		        <tr>
			    	   <th>#</th>
			    	   <th>habitacion</th>
			    	   <th>Reserva</th>
			    	   <th>Precio</th>
			    	   <th>Ver detalles</th>
		        </tr>
	        </thead>
	        <tbody>
		        @forelse($reservas as $reserva)
		    	   <tr>
		    		  <td> {{ $reserva->ID_HABITACION_RESERVA}}</td>
		    		  <td> {{ $reserva->ID_HABITACION}}</td>
		    		  <td> {{$reserva->PRECIO}}</td>
		    		  <td> {{$reserva->DETALLES}}</td>
		    		  <td>
		    			 <a >
		    				<span data-feather="list"></span>
		    				Eliminar
		    			 </a>
		    		  </td>
		    	   </tr>
		        @empty
		    	   <p>AUN NO HA AGREGADO HABITACIONES</p>
		        @endforelse
	        </tbody>
	    </table>
    </div>
@endsection
