<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\tipoHabitacion;
use App\Models\Price;
use Illuminate\Http\Request;

class tipoHabitacionController extends Controller
{

	public function index(){
	//Variable tipos va hacia el index
 	   $tipos = DB::table('TIPO_HABITACION')
		 ->join('PRECIO', 'TIPO_HABITACION.ID_PRECIO', '=', 'PRECIO.ID_PRECIO')
		 ->join('MONEDA', 'PRECIO.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
		 ->select('TIPO_HABITACION.DESCRIPCION', 'TIPO_HABITACION.PERSONAS', 'PRECIO.PRECIO', 'TIPO_HABITACION.ID_TIPO_HABITACION',
		 'MONEDA.CODIGO')
		 ->orderBy('TIPO_HABITACION.ID_TIPO_HABITACION')
		 ->get();
		// dd($tipos);
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
		$id=$tipo->ID_TIPO_HABITACION;
		   $habitaciones = DB::table('TIPO_HABITACION')
			 ->join('PRECIO', 'TIPO_HABITACION.ID_PRECIO', '=', 'PRECIO.ID_PRECIO')
			 ->join('MONEDA', 'PRECIO.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
			 ->where('TIPO_HABITACION.ID_TIPO_HABITACION', '=', $id)
			 ->select('TIPO_HABITACION.DESCRIPCION', 'TIPO_HABITACION.PERSONAS', 'PRECIO.PRECIO', 'TIPO_HABITACION.ID_TIPO_HABITACION',
			 'MONEDA.CODIGO as MONEDA')->get();
		 // dd($c, $id);
 	   return view('tiposHabitaciones.details', compact('habitaciones', 'id'));

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
