@extends('layout')
@section('title', "Fuentes de reserva")
@section('content-title',"Fuentes de reserva")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('fuentes.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nueva fuente de reserva
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
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Fuente</th>
                <th>Detalles</th>
			 <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
			  @forelse($fuentes as $fuente)
			 	<tr>
			 	    <td> {{$fuente->ID_FUENTE}}</td>
			 	    <td> {{$fuente->CODIGO}}</td>
			 	    <td> {{$fuente->DESCRIPCION}}</td>
			 	    <td>
			 		   <a href="{{route('fuentes.details',[$fuente->ID_FUENTE])}}">
			 			  <span data-feather="edit"></span>
			 			  Ver Detalles
			 		   </a>
			 	    </td>
				    <td>
					    {!! Form::open(['route'=>['fuentes.destroy', $fuente->ID_FUENTE], 'method'=>'DELETE'])!!}
						    {!! Form::submit('Eliminar', ['class'=>'btn btn-link']) !!}
					    {!! Form::close() !!}
				    </td>
			 	</tr>
			  @empty
			 	<p>NO HAY FUENTES DEFINIDAS</p>
			  @endforelse
			  {{ $fuentes->links()}}
            </tbody>
        </table>
    </div>
@endsection
