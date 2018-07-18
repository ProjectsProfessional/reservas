@extends('layout')
@section('title', "Reportes")
@section('content-title',$title)
@section('css-template')
    @parent
    <link href="{{asset("css/form-validation.css")}}" rel="stylesheet">
@endsection

@empty(!$rows->first())
    @section('content-header-buttons')
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-sm btn-outline-secondary" href="{{url('/reports/dailyReport/see')}}">
                    <span data-feather="eye"></span>
                    Ver
                </a>
                <a class="btn btn-sm btn-outline-secondary" href="{{url('/reports/dailyReport/print')}}">
                    <span data-feather="printer"></span>
                    Imprimir
                </a>
            </div>
        </div>
    @endsection
@endempty
@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>CORRELATIVO</th>
                <th>DONANTE</th>
                <th>LUGAR</th>
                <th>AREA</th>
                <th>MONEDA</th>
                <th>IMPORTE</th>
            </tr>
            </thead>
            <tbody>
            @forelse($rows as $row)
                <tr>
                    <td>{{$row->CORRELATIVO}}</td>
                    <td>{{$row->DONANTE}}</td>
                    <td>{{$row->LUGAR}}</td>
                    <td>{{$row->AREA}}</td>
                    <td>{{$row->MONEDA}}</td>
                    <td>{{$row->IMPORTE}}</td>
                </tr>
            @empty
                <p>NO SE HAN REALIZADO OFRENDAS DURANTE EL DÍA</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection