@extends('layout')
@section('title', $title)
@section('content-title',"Nuevo cliente")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="{{route('clients')}}">
                <span data-feather="arrow-left-circle"></span>
                Cancelar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <form class="needs-validation" method="POST" action="{{url('/clients')}}">
        {{csrf_field()}}
	   <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <div class="col-4 mb-3">
                <label for="description">Primer nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
		  <div class="col-4 mb-3">
		      <label for="code">Segundo nombre</label>
		      <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" required>
		  </div>
        </div>
	   <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Primer Apellido</label>
                <input type="text" class="form-control" id="primerApellido" name="primerApellido"  required>
            </div>
            <div class="col-4 mb-3">
                <label for="description">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" required>
            </div>
		  <div class="col-4 mb-3">
		      <label for="code">Telefono</label>
		      <input type="tel" class="form-control" id="telefono" name="telefono" required>
		  </div>
        </div>
	   <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Email</label>
                <input type="email" class="form-control" id="email" name="email"  required>
            </div>
            <div class="col-4 mb-3">
                <label for="description">Tipo de cliente</label>
                <input type="text" class="form-control" id="tipoCliente" name="tipoCliente"  required>
            </div>
		  <div class="col-4 mb-3">
			 <label for="description">PATH SCAN</label>
			 <input type="text" class="form-control" id="pathScan" name="pathScan" required>
		  </div>
        </div>

	   <div class="row">
		   <div class="col-12 mb-3">
 			 <label for="code">Comentarios</label>
 			 <input type="text" class="form-control" id="comentarios" name="comentarios">
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
