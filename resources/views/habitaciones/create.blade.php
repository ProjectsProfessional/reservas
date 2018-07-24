@extends('layout')
@section('title', "Media")
@section('content-title'," Cargar Media")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('habitaciones')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </button>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
	    <form class="needs-validation" method="POST" action="{{url('/habitaciones/create')}}">
             {{csrf_field()}}
             <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Habitación</label>
                      <select class="custom-select" id="inlineFormCustomSelectPref">
                        <option selected>Elegir...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                </div>
                <div class="col-12 col-sm-12 col-md-12">
                 <label for="inlineFormCustomSelectPref">Imagen</label>
                 <div class="custom-file">
                     <input type="file" class="custom-file-input" id="customFileLang" lang="es" accept="image/*">
                     <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                 </div>
                </div>
             </div>
		   <br>
             <button class="btn btn-sm btn-outline-primary">
                 <span data-feather="save"></span>
                 Guardar
             </button>
         </form>
    </div>
@endsection
