@extends('layout')
@section('title', "Reportes")
@section('content-title',$title)
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection
@section('content-header-buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <form class="needs-validation" method="POST" action="{{url('/reports/byDate')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="date-in">Del: </label>
                    <input type="date" class="form-control" name="date-in" id="date-in" placeholder="dd/mm/yyyy"  required>
                </div>
                <div class="col-6 mb-3">
                    <label for="date-end">Al: </label>
                    <input type="date" class="form-control" name="date-end" id="date-end" placeholder="dd/mm/yyyy"  required>
                </div>
            </div>
            <button class="btn btn-sm btn-outline-secondary">
                <span data-feather="printer"></span>
                Generar
            </button>
        </form>
    </div>
@endsection
