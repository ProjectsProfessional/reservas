@extends('layout')
@section('title', $title)
@section('content-title',"Nuevo cliente")
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
    <link href="{{asset("css/autocomplete.css")}}" rel="stylesheet">
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

            <div class="col-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Primer y Segundo nombre</span>
                    </div>
                    <input type="text" class="form-control" name="nombre" id="nombre"value="{{old('nombre')}}" required>
                    <input type="text" class="form-control" id="segundoNombre" name="segundoNombre">
                </div>
            </div>
       </div>
	   <div class="row">
           <div class="col-8 mb-3">
               <div class="input-group">
                   <div class="input-group-prepend">
                       <span class="input-group-text" id="">Primer y Segundo Apellido</span>
                   </div>
                   <input type="text" class="form-control" id="primerApellido" name="primerApellido" value="{{old('primerApellido')}}"  required>
                   <input type="text" class="form-control" id="segundoApellido" name="segundoApellido">
               </div>
           </div>
            <div class="col-4 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Teléfono</span>
                    </div>
                    <input type="tel" class="form-control" id="telefono" name="telefono">
                </div>
            </div>
       </div>
	   <div class="row">

            <div class="col-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Email</span>
                    </div>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-4 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Tipo de cliente</span>
                    </div>
                    <select class="form-control" name="tipoCliente" id="tipoCliente">
                        <option value="PREF">Preferencial</option>
                        <option value="ESP">Especial</option>
                        <option value="">No Aplica</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4 mb-3">
                <div class="form-group {{$errors->has('pais')?'has-error':''}}" >
                    <label for="pais">pais</label>
                    <input type="text" id="autocomplete-pais" class="form-control autocomplete" style="width: 301px !important; border:none !important;  z-index: 2; background: transparent;" required/>
                    <input type="text" id="autocomplete-pais-x" class="form-control autocomplete on-back" disabled="disabled" style="width: 301px !important; border:none !important; color: #CCC; background: transparent; z-index: 1;"/>
                    <input type="text" class="form-control on-back" id="pais" name="pais" style="color: white; background: white;z-index: 3;"  readonly="true"required>
                    {!! $errors->first('pais','<span class="help-block alert alert-danger">:message </span>') !!}
                </div>
            </div>
        </div>
	   <div class="row">
           <div class="col-8 mb-3">
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
                    <textarea type="textarea" class="form-control" id="comentarios" name="comentarios"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <button class="btn btn-lg btn-outline-primary">
                    <span data-feather="save"></span>
                    Guardar
                </button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    @include('clients.filters.country')
@endsection