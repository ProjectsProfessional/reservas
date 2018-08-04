@extends('layout')
@section('title', $title)
@section('content-title',"Tipos de habitaciones")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
    <link href="{{asset("css/autocomplete.css")}}" rel="stylesheet">
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
	<form class="" method="POST" action="{{url('/tiposHabitaciones')}}">
		{{csrf_field()}}
		<div class="row">
			<div class="col-4 mb-3">
			    <label for="code">Descripcion</label>
			    <input type="text" class="form-control" name="description" id="description" required >
			</div>
			<div class="col-4 mb-3">
			    <label for="description">Cantidad de personas</label>
			    <input type="number" class="form-control" id="personas" name="personas" id="personas" required>
			</div>
			<div class="col-4">
				<label for="description">Precios</label>
			     <input type="button" value="Agregar" class="btn btn-outline-secondary form-control" data-toggle="modal" data-target="#exampleModalLong" required>
			</div>
		</div>
		@include('modals.prices')
		<div class="row">
			<div class="col-9">
				<h3>Agregados</h3>
				<div class="table-responsive">
					<table class="table table-striped table-sm precios" id="myTable">
						<thead>
							<tr>
							   <th>Personas</th>
							   <th>Moneda</th>
							   <th>Precio</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
			    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="save();" id="enviar">
				   <span data-feather="save"></span>
				   Guardar
			    </button>
			</div>
		</div>
 	</form>
    <br><br>
@endsection

@section('scripts')
	@include('tiposHabitaciones.js.scritps')
@endsection
