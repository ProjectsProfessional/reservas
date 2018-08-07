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
                personas: row.find('#personas').val(),
                price: row.find('#price').val()
            };
            arrPrices.push(arrPrice);
            var new_row = "<tr>";
            for(var i = 0; i<1; i++)
		  {
                //console.log(arrPrice);
                //console.log(arrPrices);
                new_row +="<td>"+ row.find('#personas').val() +"</td>";
                new_row +="<td>"+ row.find('#currency:selected').eq(i).html() +"</td>";
                new_row +="<td>"+ row.find('#price').val() +"</td>";
            }
            console.log(new_row);
            new_row +="<td> <a href=\"#\" class=\"btn-outline-link\" <span data-feather=\"arrow-left-circle\"></span> regresar </a></td>";
            new_row += "</tr>";
            //console.log(new_row);
            //Nombre de la tabla
            $('.precios').append(new_row);
        });
    }
    var rowCount = $('#myTable tr').length;
    function eliminar(){
	    const arrdata = {
 	    _token: "{{ csrf_token() }}",
 	    id: $('#idPrecio').val(),
 	   };
 	   jQuery.ajax({
 	    url: "{{ route('deletePrice') }}",
 	    method: 'put',
 	    data: arrdata,
 	    success: function(result){
 		   document.location.href="{{route('tiposHabitaciones.details',[$habitacion->ID_TIPO_HABITACION])}}";
 	    },
 	    error: function(jqXHR, textStatus, errorThrown) {
 		   alert('Lo Sentimos, no se pudo eliminar.');
 		   //alert(jqXHR.responseText);
 	    }
 	   });
    }
    function update(){
        const arrdata = {
            _token: "{{ csrf_token() }}",
            description:  $('#description').val(),
            personas:  $('#personas').val(),
            precios: arrPrices,
		  id: $('#id').val(),
        };
        jQuery.ajax({
		  url: "{{ route('updateRooms') }}",
            method: 'put',
            data: arrdata,
		  success: function(result){
			 alert('Actualizado correctamente');
			 document.location.href="{{route('tiposHabitaciones')}}";
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
			 alert('Lo Sentimos, no ha sido posible crear el tipo de habitación.');
			 //alert(jqXHR.responseText);
		  }


        });

    }
    function cancelRoom(){
        $('.precios').on('click','.btn-outline-link',function () {
            var row = $(this).parents('tr');
            var id = row.find("td").eq(0).html();
            showRow(id);
            row.fadeOut();
        });
    }
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
