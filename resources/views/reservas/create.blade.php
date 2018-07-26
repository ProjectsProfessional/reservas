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
                <label for="description">Cliente</label>
                <input type="text" id="autocomplete-cliente" class="form-control autocomplete" style=" z-index: 2; background: transparent;" required/>
                <input type="text" id="autocomplete-cliente-x" class="form-control autocomplete on-back" disabled="disabled" style="color: #CCC; background: transparent; z-index: 1;"/>
                <input type="text" class="form-control on-back" id="cliente" name="cliente" value="" style="color: white; background: white;z-index: 3;"  readonly="true"required>
            </div>

            <div class="col-4 mb-3">
             <label for="description">Fuente</label>
              <input type="text"  id="autocomplete-fuente" class="form-control" style="position: absolute; z-index: 2; background: transparent;" required/>
              <input type="text"  id="autocomplete-fuente-x" class="form-control" disabled="disabled" style="color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
              <input type="text" class="form-control" id="fuente" name="fuente" style="color: white; background: white;z-index: 3 "  readonly="true"required>
            </div>

            <div class="col-4 mb-3">
                <label for="personas">Personas</label>
                <input type="number" class="form-control" id="personas" name="personas" required>
            </div>
        </div>
	   <div class="row">
		  <div class="col-4 mb-3">
			 <label for="code">Fecha de ingreso</label>
			 <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso" required>
		  </div>
		  <div class="col-4 mb-3">
			 <label for="description">Fecha de retiro</label>
			 <input type="date" class="form-control" id="fechaSalida" name="fechaSalida" required>
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
    <script>
        $('[data-toggle="popover"]').popover()
    </script>

	<script type="text/javascript" src="{{asset("js/jquery.autocomplete.js")}}"></script>
	@include('reservas.filters.customers')
	@include('reservas.filters.sources')
    <script>
        var rooms = [];
        $(document).ready(function(){
            addRoom();
            cancelRoom();
        });

        function addPrice(rowId,price) {
            var row = $("[data-id=\""+rowId+"\"]");
            var id = row.data('id');
            row.find("td").eq(3).html(price);
        }

        function restoreFoot(){
            $("#foot").remove();
            $("table.habitaciones").append('<tfoot id="foot"></tfoot>');
        }

        function addRoom(){
            $('.btn-link').click(function(){
                var row = $(this).parents('tr');
                var id = row.data('id');

                rooms.push({
                    habitacion: row.find("td").eq(0).html(),
                    precio: row.find("td").eq(3).html()
                });

                //Agrego los Vaores a la tabla
                var new_row = "<tr data-id=\""+id+"\" class=\"room-"+id+"\">";
                for(let i = 0; i<=3; i++){
                    if(i==3){
                        new_row +="<td><input id=\"precio-"+id+"\" name=\"precio-"+id+"\" type='number' class='form-control prices' onchange='priceTotal()' readonly='true' value="+row.find("td").eq(i).html()+"></td>";
                        break;
                    }
                    new_row +="<td>"+ row.find("td").eq(i).html() +"</td>";
                }
                new_row +="<input type=\"hidden\" id=\"habitacion-"+id+"\" name=\"habitacion-"+id+"\" value="+ id +">";
                new_row +="<td> <a href=\"#\" class=\"btn-outline-link\"><span></span> regresar </a></td>";
                new_row += "</tr>";

                $('.habitaciones').append(new_row);

                $("table.habitaciones tbody > tr > td > a > span").attr("data-feather","arrow-left-circle");
                feather.replace();//Refrescando el ícono
                priceTotal();
                modifyPrice();

                row.fadeOut();

            });
        };

        function priceTotal(){
            restoreFoot();
            var foot = "<th>TOTAL:</th><th></th><th></th>";
            var total = 0;

            $('.habitaciones tbody > tr').each(function (index) {
                var room_id = $(this).data('id');
                total += parseFloat(document.getElementById("precio-"+room_id).value);
            });
            foot += "<th>"+total.toFixed(2)+"</th>";
            $('#foot').append(foot);
        }

        function modifyPrice(){

            var customer = $('#cliente').val();
            const data ={
                _token:   "{{ csrf_token() }}",
                customer:   customer
            };
            $.ajax({
                url:    "{{ Route('reservas.modify-prices') }}",
                method: 'post',
                data:   data,
                success: function(result){
                    //alert(result.message);
                    if(result.message)
                        $('[class="form-control prices"]').removeAttr("readonly");
                }
            });
        }

        function cancelRoom(){
            $('.habitaciones').on('click','.btn-outline-link',function () {
                var row = $(this).parents('tr');
                var id = row.find("td").eq(0).html();
                showRow(id);
                priceTotal();
            });
        }

        function showRow(id) {
            /*accediendo a tabla de habitaciones disponibles*/
            $('#rooms-available tbody tr').each(function (index) {
                var room_id = $(this).data('id');

                if(room_id ==id){
                    $('[class="room-'+room_id+'"]').remove();
                    $(this).show();
                    return false;
                }
            });
        }

        function saveReservation(){

            const data = {
                _token: "{{ csrf_token() }}",
                cliente:            $('#cliente').val(),
                fuente:             $('#fuente').val(),
                personas:           $('#personas').val(),
                fechaIngreso:       $('#fechaIngreso').val(),
                fechaSalida:        $('#fechaSalida').val(),
                codigoVuelo:        $('#codigoVuelo').val(),
                habitaciones: rooms
            };
            $.ajax({
                url: "{{ route('reservas.save') }}",
                method: 'post',
                data: data,
                success: function(result){
                    alert(result.message);
                    document.location.href="{{route('reservas')}}";
                }});
        }
    </script>
@endsection