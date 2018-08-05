@extends('layout')
@section('title', "Detalles de la habitacion")
@section('content-title',"Detalles de la habitacion")
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
    <form class="needs-validation" method="POST" action="{{url('/tiposHabitaciones')}}">
	    {{ method_field('PUT') }}
	    {{csrf_field()}}
	        <div class="row">
	            <div class="col-4 mb-3">
	                <label for="code">Descripcion</label>
	                <input type="text" class="form-control" id="description" name="description" value="{{$habitacion->DESCRIPCION}}" required>
	            </div>
	            <div class="col-4 mb-3">
	                <label for="description">Cantidad de personas</label>
	                <input type="text" class="form-control" id="personas"  name="personas" value="{{$habitacion->PERSONAS}}" required>
	            </div>
			  <div class="col-4">
				  <label for="description">Precios</label>
				  <input type="button" value="Agregar" class="btn btn-outline-secondary form-control" data-toggle="modal" data-target="#exampleModalLong" required>
			  </div>
			  <input type="hidden" name="" id="id" value="{{$habitacion->ID_TIPO_HABITACION}}">
	        </div>
		   @include('modals.prices')
		   <hr>
	   <h3>Precios asignados</h3>
		 <div class="row">
			<div class="col-9 table-responsive">
				<table class="table table-striped table-sm" id="myTable">
					<thead>
						<tr>
						    <th>Personas</th>
						    <th>Moneda</th>
						    <th>Precio</th>
						    <th> Detalles</th>
						    <th>Eliminar</th>
						</tr>
					</thead>
						@forelse($precios as $precio)
					<tbody>
						<tr>
							<input type="hidden" name="" id="idPrecio" value="{{$precio->ID_PRECIO}}">

							<td>{{$precio->PERSONAS}}</td>
		                        	<td> {{$precio->CODIGO}}</td>
						 	<td> {{$precio->PRECIO}}</td>
		                        <td>
							    <a href="{{route('precio.details',[$precio->ID_PRECIO])}}">
								   <span data-feather="edit"></span>
								   Ver Detalles
							    </a>
		                        </td>
						    <td>
							    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="eliminar();" id="delete">
								   <span data-feather="trash-2"></span>
								   Eliminar
							    </button>
						    </td>
		                    </tr>
					</tbody>
					@empty
						<p>No existen precios</p>
					@endforelse
				</table>
			</div>
		</div>
			<h3>Recientes</h3>
			<div class="col-9 table-responsive">
				<table class="table table-striped table-sm precios">
					<thead>
						<tr>
						    <th>Personas</th>
						    <th>Moneda</th>
						    <th>Precio</th>
						    <th>Detalles</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
	   <div class="row">
            <div class="col-12"></div>
            <div class="col-6">
                <button type="button" onclick="update();" id="enviar" class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Actualizar
                </button>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
	@include('precio.js.scritps')
@endsection
