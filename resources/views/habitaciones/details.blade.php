@extends('layout')
@section('title', "Listado de habitaciones")
@section('content-title',"Habitaciones")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">
                <span data-feather="refresh-cw"></span>
                Actualizar
            </button>
            <a class="btn btn-sm btn-outline-secondary" href="{{route('habitaciones')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" novalidate>
        <div class="row">
            <div class="col-6 mb-3">
                <label for="areas">Código</label>
                <input type="text" class="form-control" id="Area" value="">

            </div>
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" placeholder="Edite nombre del área" value="">

            </div>
        </div>
    </form>
@endsection
