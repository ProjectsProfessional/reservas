@extends('layout')
@section('title', $title)
@section('content-title',"Nuevo estado")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('estados')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/estados')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
        </div>
	   <div class="col-12">
		  <button class="btn btn-sm btn-outline-secondary">
			 <span data-feather="save"></span>
			 Guardar
		  </button>
	   </div>
    </form>
@endsection
