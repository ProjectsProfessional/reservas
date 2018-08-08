@extends('layout')
@section('title', "Reservas")
@section('content-title',"Reservas")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal"
               href="">
                <span data-feather="arrow-up-circle"></span>
                Nueva Reserva
            </button>
            @include('modals.reservations.DatesAvailables')
        </div>
    </div>
@endsection
@section('content')
    <h2>Resumen</h2>
    <input type="text" id="myInput" onkeyup="search()" placeholder="Buscar.." class="form-control">
    <div class="table-responsive">
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <table class="table table-striped table-sm" id="myTable">
            <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Fuente</th>
                <th>Personas</th>
                <th>Estado</th>
                <th>Del</th>
                <th>Al</th>
                <th>Cod de vuelo</th>
                <th>Importe</th>
                <th>Detalles</th>
            </tr>
            </thead>
            <tbody>

            @forelse($reservas as $reserva)
                <tr id="tableSearch">
                    <td>{{$reserva->CODIGO}}</td>
                    <td>{{$reserva->NOMBRE}}</td>
                    <td>{{$reserva->FUENTE}}</td>
                    <td>{{$reserva->PERSONAS}}</td>
                    <td>{{$reserva->ESTADO}}</td>
                    <td>{{$reserva->FECHA_INGRESO}}</td>
                    <td>{{$reserva->FECHA_RETIRO}}</td>
                    <td>{{$reserva->CODIGO_VUELO}}</td>
                    <td>
                        @if($reserva->MONEDA == 'ANULADA')
                            ({{$reserva->MONEDA}})
                        @else
                            ({{$reserva->MONEDA}}){{$reserva->IMPORTE}}
                        @endif
                    </td>
                    <td>
                        <a href="{{route('reservas.details',[$reserva->ID_RESERVA])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
                </tr>
            @empty
                <p>NO EXISTEN RESERVAS</p>
            @endforelse
		  {{ $reservas->links()}}
            </tbody>
        </table>
    </div>
@endsection
<script type="text/javascript">
    function search() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            codigo = tr[i].getElementsByTagName("td")[0];
            cliente = tr[i].getElementsByTagName("td")[1];
            nombre = tr[i].getElementsByTagName("td")[2];
            estado = tr[i].getElementsByTagName("td")[4];
            desde = tr[i].getElementsByTagName("td")[5];
            if ((codigo) || (nombre) || (estado) ||(desde)) {
                if (
                    (codigo.innerHTML.toUpperCase().indexOf(filter) > -1) ||
                    (nombre.innerHTML.toUpperCase().indexOf(filter) > -1) ||
                    (estado.innerHTML.toUpperCase().indexOf(filter) > -1) ||
                    (cliente.innerHTML.toUpperCase().indexOf(filter) > -1)  ||
                    (desde.innerHTML.toUpperCase().indexOf(filter) > -1)
                ){
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>