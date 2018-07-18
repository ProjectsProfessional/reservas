@extends('layout')
@section('title', "Precios")
@section('content-title',"Precios")

@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('precio.create')}}">
                <span data-feather="arrow-up-circle"></span>
                Nuevo precio
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
                <th>Moneda</th>
                <th>Precio</th>
                <th>Detalles</th>
            </tr>
            </thead>
            <tbody>
			  @forelse($precios as $precio)
	                <tr>
	                    <td> {{$precio->ID_PRECIO}}</td>
	                    <td> {{$precio->ID_MONEDA}}</td>
	                    <td> {{$precio->PRECIO}}</td>
	                    <td>
	                        <a href="{{route('precio.details',[$precio->ID_PRECIO])}}">
	                            <span data-feather="edit"></span>
	                            Ver Detalles
	                        </a>
	                    </td>
	                </tr>
	            @empty
	                <p><strong>NO HAY HABITACIONES DEFINIDAS</strong></p>
	            @endforelse
            </tbody>
        </table>
    </div>
@endsection
