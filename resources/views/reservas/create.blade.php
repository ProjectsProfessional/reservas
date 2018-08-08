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
    <div id="errors">

    </div>
    <form class="needs-validation" method="POST" action="{{url('/reservas')}}">
        {{csrf_field()}}
        <div class="row">

            <div class="col-2 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="code" name="code" onchange="validCode();" required>
            </div>

            <div class="col-4 mb-3">
                <label for="description">Cliente</label>
                <input type="text" id="autocomplete-cliente" class="form-control autocomplete" onchange="clearRooms();" style="width: 290px !important; border:none !important;  z-index: 2; background: transparent;" required/>
                <input type="text" id="autocomplete-cliente-x" class="form-control autocomplete on-back" disabled="disabled" style="width: 290px !important; border:none !important; color: #CCC; background: transparent; z-index: 1;"/>
                <input type="text" class="form-control on-back" id="cliente" name="cliente"  style="color: white; background: white;z-index: 3;"  readonly="true"required>
            </div>

            <div class="col-3 mb-3">
             <label for="description">Fuente</label>
              <input type="text"  id="autocomplete-fuente" class="form-control" onchange="validSource()" style="width: 210px !important; border:none !important; position: absolute; z-index: 2; background: transparent;" required/>
              <input type="text"  id="autocomplete-fuente-x" class="form-control" disabled="disabled" style="width: 210px !important; border:none !important; color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
              <input type="text" class="form-control" id="fuente" name="fuente" style="color: white; background: white;z-index: 3 "  readonly="true"required>
            </div>

            <div class="col-3 mb-3">
                <label for="personas">Personas</label>
                <input type="number" class="form-control" id="personas" name="personas" required>
            </div>
        </div>
	   <div class="row">
		  <div class="col-4 mb-3">
			 <label for="code">Fecha de ingreso</label>
			 <input type="date" disabled class="form-control" id="fechaIngreso" name="fechaIngreso" value="{{$dateIn}}" required>
		  </div>
		  <div class="col-4 mb-3">
			 <label for="description">Fecha de retiro</label>
			 <input type="date" disabled class="form-control" id="fechaSalida" name="fechaSalida"value="{{$dateOut}}" required>
		  </div>
	    <div class="col-4 mb-3">
		   <label for="description">Codigo de vuelo</label>
		   <input type="text" class="form-control" id="codigoVuelo" name="codigoVuelo">
	    </div>
	   </div>
		<div class="row">
			<div class="col-3 mb-3">

				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2">
						<button type="button" id="btnRooms" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModalLong">
							habitaciones
						</button>
						@include('modals.reservations.Rooms')
					</div>
				</div>
			</div>
			<div class="col-9">
				<h3>Agregadas</h3>
				<div class="table-responsive">
					<table class="table table-striped table-sm habitaciones">
						<thead>
						<tr>
                            <th>Habitación</th>
                            <th>Tipo De Habitación</th>
                            <th>Detalles</th>
                            <th>Moneda</th>
                            <th>precio</th>
                            <th>Acción</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
                        <tfoot id="foot">
                        </tfoot>
					</table>
				</div>
			</div>
		</div>

        <div class="row">
		   <br><br>
            <div class="col-12"></div>
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="saveReservation();">
                    <span data-feather="save"></span>
                    Reservar
                </button>
            </div>
        </div>
    </form>
    <br><br>
@endsection

@section('scripts')
    @include('reservas.js.scritps')
@endsection
