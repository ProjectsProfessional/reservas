@extends('layout')
@section('title', "Impuestos")
@section('content-title',"Impuestos")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('impuestos.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nuevo
            </a>
        </div>
    </div>
@endsection
@section('content')
    <h2>Resumen</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
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

            @forelse($impuestos as $impuesto)
                <tr>
                    <td> {{$impuesto->ID_IMPUESTO}}</td>
                    <td> {{$impuesto->CODIGO}}</td>
                    <td> {{$impuesto->TASA}}</td>
                    <td>
                        <a href="{{route('impuestos.details',[$impuesto->ID_IMPUESTO])}}">
                            <span data-feather="edit"></span>
                            Ver Detalles
                        </a>
                    </td>
				<td>
					{!! Form::open(['route'=>['impuestos.destroy', $impuesto->ID_IMPUESTO], 'method'=>'DELETE'])!!}
						{!! Form::submit('Eliminar', ['class'=>'btn btn-link']) !!}
					{!! Form::close() !!}
				</td>
                </tr>
            @empty
                <p>NO HAY IMPUESTOS DEFINIDAS</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
