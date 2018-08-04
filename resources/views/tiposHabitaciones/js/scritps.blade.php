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
            var new_row = "<tr onclick=\"myFunction(this)\">";
            for(var i = 0; i<1; i++){
                new_row +="<td>"+ row.find('#personas').val() +"</td>";
                new_row +="<td>"+ row.find('#currency:selected').eq(i).html() +"</td>";
                new_row +="<td>"+ row.find('#price').val() +"</td>";
            }
            new_row +="<td> <a href=\"#\" class=\"btn-outline-link\" <span data-feather=\"arrow-left-circle\"></span> regresar </a></td>";
            new_row += "</tr>";
            $('.precios').append(new_row);
        });
    }
    function save(){
        const arrdata = {
            _token: "{{ csrf_token() }}",
            description:  $('#description').val(),
            personas:  $('#personas').val(),
            precios: arrPrices
        };
        jQuery.ajax({
            url: "{{ route('saveRooms') }}",
            type: 'POST',
            data: arrdata,
            success: function(result){
                alert(result.success);
                document.location.href="{{route('tiposHabitaciones')}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Lo Sentimos, no ha sido posible crear el tipo de habitación.');
                //alert(jqXHR.responseText);
            }
        });

    }
    function destroy(row) {
	    //index de la columna
	    index=row.rowIndex-1;
	    //lo saco del arreglo
	    arrPrices.splice(index, 1);
	    //elimino la columna
	    document.getElementById("myTable").deleteRow(index);
	    //Visual
	    row.fadeOut();
    }
    function cancelRoom(){
        $('.precios').on('click','.btn-outline-link',function () {
            var row = $(this).parents('tr');
            //var id = row.find("td").eq(0).html(;
           // row.fadeOut();
        });
    }
</script>
