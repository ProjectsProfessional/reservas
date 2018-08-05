@extends('layout')
@section('title', "Clientes")
@section('content-title',"Clientes")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('clients.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nuevo Cliente
            </a>
        </div>
    </div>
@endsection
@section('content')
	@if (session('fallo'))
	    <div class="alert alert-danger alert-dismissible fade show" role="alert">
	    {{ session('fallo') }}
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		 <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	@endif
    <h2>Resumen</h2>
    <div class="table-responsive">
	<br>
	<input type="text" id="myInput" onkeyup="search()" placeholder="Buscar.." class="form-control">
	<hr>
        <table class="table table-striped table-sm" id="myTable"	>
            <thead>
            <tr>
	           <th>#</th>
	           <th>Código</th>
	           <th>Nombre</th>
		      <th>Apellido</th>
		      <th>Telefono</th>
	           <th>Email</th>
	           <th>Detalles</th>
			 <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @forelse($client as $client1)
                <tr id="tableSearch">
                    	<td> {{$client1->ID_CLIENTE}}</td>
				    <td> {{$client1->CODIGO}}</td>
                    	<td> {{$client1->NOMBRE1}}</td>
				    <td> {{$client1->APELLIDO1}}</td>
				    <td> {{$client1->TELEFONO}}</td>
				    <td> {{$client1->EMAIL}}</td>
                    <td>
                        <a href="{{route('clients.details',[$client1->ID_CLIENTE])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
				<td>
					{!! Form::open(['route'=>['clients.destroy', $client1->ID_CLIENTE], 'method'=>'DELETE'])!!}
						{!! Form::submit('Eliminar', ['class'=>'btn btn-danger']) !!}
					{!! Form::close() !!}
				</td>
                </tr>
            @empty
                <p>NO EXISTEN CLIENTES</p>
            @endforelse
			{{ $client->links()}}
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
    function search() {
	    var input, filter, table, tr, td, i;
	    input = document.getElementById("myInput");
	    filter = input.value.toUpperCase();
	    table = document.getElementById("myTable");
	    tr = table.getElementsByTagName("tr");
	    for (i = 0; i < tr.length; i++) {
	      nombre = tr[i].getElementsByTagName("td")[2];
		 apellido = tr[i].getElementsByTagName("td")[3];
	      if ((nombre) || (apellido)) {
	        if ((nombre.innerHTML.toUpperCase().indexOf(filter) > -1) || (apellido.innerHTML.toUpperCase().indexOf(filter) > -1)) {
	          tr[i].style.display = "";
	        } else {
	          tr[i].style.display = "none";
	        }
	      }
	    }
	}
    </script>
@endsection
