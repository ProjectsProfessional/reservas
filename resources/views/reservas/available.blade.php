@extends('layout')
@section('title', "Disponibilidad")
@section('content-title',"Disponibilidad de habitaciones")

@section('content-header-buttons')

@endsection
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Desde</span>
                </div>
                <input type="date" class="form-control" id="from" name="from">
            </div>
        </div>

        <div class="col-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">hasta</span>
                </div>
                <input type="date" class="form-control" id="to" name="to">
            </div>
        </div>

        <div class="col-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Tipo de Búsqueda</span>
                </div>
                <select class="form-control" name="filter" id="filter" required>
                    <option value="available">Hab Disponibles</option>
                    <option value="unavailable">Hab Reservadas</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="col-12"></div>
        <div class="col-6">
            <button type="button" class="btn btn-lg btn-outline-primary" onclick="saveReservation();">
                <span data-feather="save"></span>
                Buscar...
            </button>
        </div>
    </div>
@endsection