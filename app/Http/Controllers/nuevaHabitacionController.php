<?php

namespace App\Http\Controllers;

use App\Models\nuevaHabitacion;
use App\Models\tipoHabitacion;
use App\Models\EstadoHabitacion;
use Illuminate\Http\Request;

class nuevaHabitacionController extends Controller
{
	public function index(){
	    $habitaciones = nuevaHabitacion::all();
	    $title = 'Listado habitacion';
	    return view('nuevasHabitaciones.index', compact('habitaciones','title'));
	}
	public function create(){
		$habitaciones=tipoHabitacion::all();
		$tipos=EstadoHabitacion::all();
	    $title = 'Definir habitaciones';
	    return view('nuevasHabitaciones.create',compact('tipos','habitaciones','title'));
	}
	public function details(nuevaHabitacion $habitaciones){
	  // dd($currency);
	    return view('nuevasHabitaciones.details',compact('habitaciones'));
	}
	public function store(){
	    $data = request()->all();
	  //dd($data);
	    nuevaHabitacion::create([
		    'ID_TIPO_HABITACION' => $data['tipo'],
		    'ID_ESTADO_HABITACION'   => $data['estado'],
		    'DETALLES' => $data['description'],
	    ]);
	    return redirect()->route('nuevasHabitaciones');
	}
	public function update(nuevaHabitacion $habitaciones){
	   $data = request()->all();
	    //dd($data);
	    $habitaciones->update([
		    'ID_TIPO_HABITACION' => $data['tipo'],
		    'ID_ESTADO_HABITACION'   => $data['estado'],
		    'DETALLES' => $data['description'],
	    ]);
	   return redirect()->route('nuevasHabitaciones');
	}
}
