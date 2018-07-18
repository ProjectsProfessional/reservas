@extends('layout')
@section('title', $title)
@section('content-title',"Nueva Moneda")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('reservas')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/reservas')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="code" name="code" placeholder="USD">
            </div>
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Dolar americano">
            </div>
        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <button class="btn btn-sm btn-outline-secondary">
                    <span data-feather="save"></span>
                    Guardar
                </button>
            </div>
        </div>
    </form>
@endsection
