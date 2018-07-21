<?php

namespace App\Http\Controllers;

use App\Models\habitacion_reserva;
use Illuminate\Http\Request;

class habitacionReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function store(){
 	   $data = request()->all();
 	  //dd($data);
 	   habitacion_reserva::create([
 		  'ID_HABITACION' => $data['idHabitacion'],
 		  'ID_RESERVA'   => $data['reserva'],
 		  'PRECIO'   => $data['PRECIO'],
 	   ]);
 	   //return redirect()->route('reservas');
     }
}
