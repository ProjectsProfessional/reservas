@extends('layout')
@section('title', $title)
@section('content-title',"Nueva impuesto")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('impuestos')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/impuestos')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="code" name="code">
            </div>
            <div class="col-6 mb-3">
                <label for="description">Tasa</label>
                <input type="Number" class="form-control" id="tasa" name="tasa">
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
