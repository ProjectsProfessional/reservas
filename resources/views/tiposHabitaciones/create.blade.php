@extends('layout')
@section('title', $title)
@section('content-title',"Nuevo tipo de habitacion")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('tiposHabitaciones')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/tiposHabitaciones')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Descripcion</label>
                <input type="text" class="form-control" name="description" required >
            </div>
            <div class="col-4 mb-3">
                <label for="description">Cantidad de personas</label>
                <input type="text" class="form-control" id="personas" name="personas" required>
            </div>
            <div class="col-4 mb-3">
                <label for="pay">Precios ...</label>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModalLong">
                            <span data-feather="dollar-sign"></span>
                            Precios ...
                        </a>
                        @include('modals.prices')
                    </div>
                </div>
            </div>
        <div class="row">
	   </div>
            <div class="col-12"></div>
            <div class="col-6">
                <button class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Guardar
                </button>
            </div>
        </div>
    </form>
@endsection
