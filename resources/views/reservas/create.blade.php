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

				<input type="text" id="autocomplete-cliente" class="form-control autocomplete" style=" z-index: 2; background: transparent;"/>
				<input type="text" id="autocomplete-cliente-x" class="form-control autocomplete on-back" disabled="disabled" style="color: #CCC; background: transparent; z-index: 1;"/>
                <input type="text" class="form-control on-back" id="cliente" name="cliente" value="" style="color: white; background: white;z-index: 3;"  readonly="true">
            </div>

		  <div class="col-4 mb-3">
			 <label for="description">Fuente</label>
			  <input type="text"  id="autocomplete-fuente" class="form-control" style="position: absolute; z-index: 2; background: transparent;"/>
			  <input type="text"  id="autocomplete-fuente-x" class="form-control" disabled="disabled" style="color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
			  <input type="text" class="form-control" id="fuente" name="fuente" style="color: white; background: white;z-index: 3 " disabled="disabled" readonly="true">
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
		   <input type="text" class="form-control" id="description" name="codigoVuelo">
	    </div>
	   </div>
		<div class="row">
			<div class="col-3 mb-3">

				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2">
						<button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModalLong">
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
                            <th>Acción</th>
						</tr>
						</thead>
						<tbody>
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
	@include('reservas.filters.customers')
	@include('reservas.filters.sources')

    <script>
        $(document).ready(function(){
            addRoom();
            cancelRoom();

        });

        function addRoom(){
            $('.btn-link').click(function(){
                var row = $(this).parents('tr');
                //Agrego los Vaores a la tabla
                var new_row = "<tr>";
                for(var i = 0; i<=2; i++){
                    new_row +="<td>"+ row.find("td").eq(i).html() +"</td>";
                }
                new_row +="<td> <a href=\"#\" class=\"btn-outline-link\"><span data-feather=\"arrow-left-circle\"></span> regresar </a></td>";
                new_row += "</tr>";
                $('.habitaciones').append(new_row);
                row.fadeOut();

            });
        };

        function cancelRoom(){
            $('.habitaciones').on('click','.btn-outline-link',function () {
                var row = $(this).parents('tr');
                var id = row.find("td").eq(0).html();
                showRow(id);
                row.fadeOut();
            });
        };

        function showRow(id) {
            /*accediendo a tabla de habitaciones disponibles*/
            $('#rooms-available tbody tr').each(function (index) {
                var room_id = $(this).data('id');
                if(room_id ==id){
                    $(this).show();
                    return false;
                }
            });
        }
    </script>
@endsection