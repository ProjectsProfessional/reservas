@extends('layout')
@section('title', "Detalles")
@section('content-title',"Detalles del cliente ".$client->CODIGO)
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
    <form class="needs-validation" method="POST" action="{{url("/clients/{$client->ID_CLIENTE}")}}">
	  {{ method_field('PUT') }}
        {{csrf_field()}}
        <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="firstName" name="codigo"readonly="true"  value="{{$client->CODIGO}} ">
            </div>
            <div class="col-4 mb-3">
                <label for="description">Primer nombre</label>
                <input type="text" class="form-control" id="lastName"  name="nombre" value="{{$client->NOMBRE1}}">
            </div>
		  <div class="col-4 mb-3">
		      <label for="code">Segundo nombre</label>
		      <input type="text" class="form-control" id="firstName" name="segundoNombre" value="{{$client->NOMBRE2}}">
		  </div>
        </div>
	   <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Primer Apellido</label>
                <input type="text" class="form-control" id="firstName" name="primerApellido"  value="{{$client->APELLIDO1}}">
            </div>
            <div class="col-4 mb-3">
                <label for="description">Segundo Apellido</label>
                <input type="text" class="form-control"  name="segundoApellido" value="{{$client->APELLIDO2}}">
            </div>
		  <div class="col-4 mb-3">
		      <label for="code">Telefono</label>
		      <input type="text" class="form-control" id="firstName" name="telefono" value="{{$client->TELEFONO}}">
		  </div>
        </div>
	   <div class="row">
            <div class="col-4 mb-3">
                <label for="code">Email</label>
                <input type="text" class="form-control" id="firstName" name="email" value="{{$client->EMAIL}}">
            </div>

            <div class="col-4 mb-3">
                <label for="tipoCliente">Tipo de cliente</label>
                <select class="form-control" name="tipoCliente" id="tipoCliente">
                    <option @if(is_null($client->TIPO_CLIENTE)) selected="true" @endif value="">No Aplica</option>
                    <option @if($client->TIPO_CLIENTE =='PREF') selected="true" @endif  value="PREF">Preferencial</option>
                    <option @if($client->TIPO_CLIENTE =='ESP') selected="true" @endif   value="ESP">Especial</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input form-control" id="pathScan" name="pathScan">
                        <label class="custom-file-label" for="inputGroupFile02">Documento del cliente</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Comentarios</span>
                    </div>
                    <textarea type="text" class="form-control" id="firstName" name="comentarios" value="{{$client->COMENTARIOS}}"></textarea>
                </div>
            </div>
        </div>
	   <button class="btn btn-sm btn-outline-secondary">
		  <span data-feather="save"></span>
		  Actualizar
	   </button>
    </form>
@endsection
