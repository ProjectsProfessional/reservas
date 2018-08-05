<script>
    $('document').ready(function(){
        $('#pay').click(function(){
            var option = confirm("Marcar la reservación como pagada?")
            if (option) {
                const data ={
                    _token:   "{{ csrf_token() }}",
                    reserva:   {{$reserva->ID_RESERVA}}
                };
                $.ajax({
                    url:"{{route('reserva.pay')}}",
                    method: 'post',
                    data: data,
                    success: function(result){
                        alert(result.message);
                        document.location.href="{{route('reservas')}}";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('No fue posible pagar la reservación, contacte con el administrador del sistema');
                        //alert(jqXHR.responseText);
                    }
                });
            }
        });

        $('#cancel').click(function(){

            var option = confirm("Está seguro que desea anular la reserva?")
            if (option) {
                const data ={
                    _token:   "{{ csrf_token() }}",
                    reserva:   {{$reserva->ID_RESERVA}}
                };
                $.ajax({
                    url:"{{route('reserva.cancel')}}",
                    method: 'post',
                    data: data,
                    success: function(result){
                        alert(result.message);
                        document.location.href="{{route('reservas')}}";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //alert('No fue posible anular la reservación, contacte con el administrador del sistema');
                        alert(jqXHR.responseText);
                    }
                });
            }
        });
    });
</script>