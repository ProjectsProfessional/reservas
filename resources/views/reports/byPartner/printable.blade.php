@extends('printableLayout')
@section('content')
    <h1>{{ $titles["title1"] }}</h1>
    <h2>{{ $titles["title2"] }}</h2>
    <h2>{{ $titles["title3"] }}</h2>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>CORRELATIVO</th>
                <th>LUGAR</th>
                <th>AREA</th>
                <th>MONEDA</th>
                <th>IMPORTE</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{$row->CORRELATIVO}}</td>
                    <td>{{$row->LUGAR}}</td>
                    <td>{{$row->AREA}}</td>
                    <td>{{$row->MONEDA}}</td>
                    <td>{{$row->IMPORTE}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection