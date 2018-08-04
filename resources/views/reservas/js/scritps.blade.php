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

    function addPrice(rowId,currency,price) {
        var row = $("[data-id=\""+rowId+"\"]");
        var id = row.data('id');
        row.find("td").eq(3).html(currency);
        row.find("td").eq(4).html(price);
    }

    function restoreFoot(){
        $("#foot").remove();
        $("table.habitaciones").append('<tfoot id="foot"></tfoot>');
    }

    function addRoom(){
        $('.btn-link').click(function(){
            var row = $(this).parents('tr');
            var id = row.data('id');
            var price = false;

            rooms.push({
                habitacion: row.find("td").eq(0).html(),
                moneda: row.find("td").eq(3).html(),
                precio: row.find("td").eq(4).html()
            });

            //Agrego los Valores a la tabla
            var new_row = "<tr data-id=\""+id+"\" class=\"room-"+id+"\">";
            for(let i = 0; i<=4; i++){
                if(i==4){
                    new_row +="<td><input id=\"precio-"+id+"\" name=\"precio-"+id+"\" type='number' class='form-control prices' onchange='priceTotal()' readonly='true' value="+row.find("td").eq(i).html()+"></td>";
                    price = ($.isNumeric(row.find("td").eq(i).html()))
                    break;
                }
                new_row +="<td>"+ row.find("td").eq(i).html() +"</td>";
            }
            new_row +="<input type=\"hidden\" id=\"habitacion-"+id+"\" name=\"habitacion-"+id+"\" value="+ id +">";
            new_row +="<td> <a href=\"#\" class=\"btn-outline-link\"><span></span> regresar </a></td>";
            new_row += "</tr>";

            if(!price){
                alert('Debe Asignar precio a la habitación');
                return false;
            }
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
        var foot = "<th>TOTAL:</th><th></th><th></th><th></th>";
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
            },error: function(jqXHR, textStatus, errorThrown) {
                alert('Es necesario seleccionar el cliente en la reserva');
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

    function showRow() {
        /*accediendo a tabla de habitaciones disponibles*/
        $('#rooms-available tbody tr').each(function (index) {
            var room_id = $(this).data('id');
            $('[class="room-'+room_id+'"]').remove();
            $(this).show();
        });
        restoreFoot();
    }
    function saveReservation(){

        if($.isEmptyObject(rooms)){

            alert("No se ha agregado habitaciones a la reserva");
            return false;
        }
        const data = {
            _token: "{{ csrf_token() }}",
            code:               $('#code').val(),
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('No fue posible crear la reserva, contacte con el administrador del sistema');
                //alert(jqXHR.responseText);
            }
        });
    }

</script>