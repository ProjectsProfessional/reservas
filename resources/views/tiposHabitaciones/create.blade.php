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
			<div class="col-6 mb-3">
			    <label for="code">Descripcion</label>
			    <input type="text" class="form-control" name="description" id="description" required >
			</div>
			<div class="col-6 mb-3">
			    <label for="description">Cantidad de personas</label>
			    <input type="number" class="form-control" id="personas" name="personas" id="personas" required>
			</div>
		</div>
		@include('modals.prices')
		<a data-toggle="modal" data-target="#exampleModalLong">Agregar precio</a>
		<div class="row">
			<div class="col-9">
				<h3>Agregados</h3>
				<div class="table-responsive">
					<table class="table table-striped table-sm precios">
						<thead>
							<tr>
							   <th>Moneda</th>
							   <th>Impuesto</th>
							   <th>Bruto</th>
							   <th>Precio</th>
							   <th></th>
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
			    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="test();" id="enviar">
				   <span data-feather="save"></span>
				   Guardar
			    </button>
			</div>
		</div>
 	</form>
    <br><br>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset("js/jquery.mockjax.js")}}"></script>
	<script type="text/javascript" src="{{asset("js/jquery.autocomplete.js")}}"></script>
    <script>
        $(document).ready(function(){
            addPrice();
            cancelRoom();
        });
	   let arrPrices = [];
	   function addPrice(){
		//Boton del modal

		  $('#btnModal').click(function(){
			 var row = $(this).parents('#cont');
			 var id = row.data('id');
			 //Agrego los Vaores a la tabla
			 const arrPrice = {
				 moneda: row.find('#currency:selected').val(),
				 impuesto: row.find('#impuesto:selected').val(),
				 gross: row.find('#grossTotal:selected').val(),
				 price: row.find('#price').val()
			 };
			 arrPrices.push(arrPrice);
			 var new_row = "<tr>";
			 for(var i = 0; i<1; i++){
				 console.log(arrPrice);
				 console.log(arrPrices);
				new_row +="<td>"+ row.find('#currency:selected').eq(i).html() +"</td>";
				new_row +="<td>"+ row.find('#impuesto:selected').eq(i).html() +"</td>";
				new_row +="<td>"+ row.find('#grossTotal:selected').eq(i).html() +"</td>";
				new_row +="<td>"+ row.find('#price').val() +"</td>";
			 }
		 	console.log(new_row);
			 new_row +="<td> <a href=\"#\" class=\"btn-outline-link\"><span data-feather=\"arrow-left-circle\"></span> regresar </a></td>";
			 new_row += "</tr>";
			 console.log(new_row);
		   //Nombre de la tabla
			 $('.precios').append(new_row);
		  });
	   };

	   function test(){
		 	const arrdata = {
				_token: "{{ csrf_token() }}",
			    description:  $('#description').val(),
			    personas:  $('#personas').val(),
			    precios: arrPrices
			};
		   jQuery.ajax({
			 url: "{{ route('saveRooms') }}",
			 method: 'post',
			 data: arrdata,
			 success: function(result){
				 document.location.href="{{route('tiposHabitaciones')}}";
			 }});

	   }
	   jQuery(document).ready(function(){

	   });
        function cancelRoom(){
            $('.precios').on('click','.btn-outline-link',function () {
                var row = $(this).parents('tr');
                var id = row.find("td").eq(0).html();
                showRow(id);
                row.fadeOut();
            });
        };
        function showRow(id) {
            /*accediendo a tabla de habitaciones disponibles*/
		  //ID tabla de la vista rooms
		  //table->tbody->tr
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
