@extends('layout')
@section('title', $title)
@section('content-title',"Nueva fuente de reserva")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('fuentes')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/fuentes')}}">
        <div class="row">
		   {{csrf_field()}}
            <div class="col-6 mb-3">
                <label for="code">Codigo</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <div class="col-6 mb-3">
                <label for="description">Descripcion</label>
                <input type="text" class="form-control" id="description" name="description"  required>
            </div>
        </div>
        <div class="row">
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
