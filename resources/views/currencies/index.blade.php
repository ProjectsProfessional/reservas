@extends('layout')
@section('title', "Monedas")
@section('content-title',"Monedas")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('currencies.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nueva Moneda
            </a>
        </div>
    </div>
@endsection
@section('content')
    <h2>Resumen</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
		   @if (session('fallo'))
		   <div class="alert alert-danger alert-dismissible fade show" role="alert">
			   {{ session('fallo') }}
		   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		   </button>
			@endif
		   </div>
            <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Descripcion</th>
                <th>Detalles</th>
			    <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @forelse($currencies as $currency)
                <tr>
                    <td> {{$currency->ID_MONEDA}}</td>
                    <td> {{$currency->CODIGO}}</td>
                    <td> {{$currency->DESCRIPCION}}</td>
                    <td>
                        <a href="{{route('currencies.details',[$currency->ID_MONEDA])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
				<td>
					{!! Form::open(['route'=>['currencies.destroy', $currency->ID_MONEDA], 'method'=>'DELETE'])!!}
						{!! Form::submit('Eliminar', ['class'=>'btn btn-link'],['data-feather'=>'edit']) !!}
					{!! Form::close() !!}
				</td>
                </tr>
            @empty
                <p>NO HAY MONEDAS DEFINIDAS</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
