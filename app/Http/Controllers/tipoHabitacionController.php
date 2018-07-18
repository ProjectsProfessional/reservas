<?php

namespace App\Http\Controllers;

use App\Models\tipoHabitacion;
use App\Models\Price;
use Illuminate\Http\Request;

class tipoHabitacionController extends Controller
{

	public function index(){
	//Variable tipos va hacia el index
 	   $tipos = tipoHabitacion::all();
 	   $title = 'Listado';

 	   return view('tiposHabitaciones.index', compact('tipos','title'));
     }
     public function create(){
 	   $title = 'Definir habitacion';
	   $precios=Price::all();
	  // round((float)$precios);
	   //dd($precios);
 	   return view('tiposHabitaciones.create',compact('precios','title'));
     }
     public function details(tipoHabitacion $tipo){
	//	dd($tipo);
 	   return view('tiposHabitaciones.details',compact('tipo'));
     }

     public function store(){
 	   $data = request()->all();
 	   tipoHabitacion::create([
 		  'ID_PRECIO' => $data['precio'],
 		  'DESCRIPCION'   => $data['description'],
		  'PERSONAS'   => $data['personas'],
 	   ]);
 	   return redirect()->route('tiposHabitaciones');
   }
   public function update(tipoHabitacion $tipo){
	$data = request()->all();
	 //dd($data);
	 $tipo->update([
		 'ID_PRECIO' => $data['precio'],
		 'DESCRIPCION'   => $data['description'],
		 'PERSONAS'   => $data['personas'],
	 ]);
	return redirect()->route('tiposHabitaciones');
}
}
