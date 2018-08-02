<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\nuevaHabitacion;
use App\Models\tipoHabitacion;
use App\Models\EstadoHabitacion;
use Illuminate\Http\Request;

class nuevaHabitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
	    $habitaciones =  DB::table('HABITACION')
		  ->join('ESTADO_HABITACION', 'ESTADO_HABITACION.ID_ESTADO_HABITACION','=', 'HABITACION.ID_ESTADO_HABITACION')
		   ->join('TIPO_HABITACION', 'HABITACION.ID_TIPO_HABITACION', '=', 'TIPO_HABITACION.ID_TIPO_HABITACION')
		  ->select('ESTADO_HABITACION.DESCRIPCION AS ESTADO', 'HABITACION.ID_HABITACION AS ID_HABITACION',
			   'TIPO_HABITACION.DESCRIPCION AS DESCRIPCION',
			  'HABITACION.DETALLES AS DETALLES', 'HABITACION.ID_TIPO_HABITACION',
			  'HABITACION.ID_ESTADO_HABITACION')
		  ->paginate(10);
	    $title = 'Listado habitacion';
	    return view('nuevasHabitaciones.index', compact('habitaciones','title'));
	}
	public function create(){
		$habitaciones=tipoHabitacion::all();
		$tipos=EstadoHabitacion::all();
	    $title = 'Definir habitaciones';
	    return view('nuevasHabitaciones.create',compact('tipos','habitaciones','title'));
	}
	public function details(nuevaHabitacion $habitacion){
	   $id=$habitacion->ID_HABITACION;
	   //dd($id);
	   $habitaciones =  DB::table('HABITACION')
	     ->join('ESTADO_HABITACION', 'ESTADO_HABITACION.ID_ESTADO_HABITACION','=', 'HABITACION.ID_ESTADO_HABITACION')
		->join('TIPO_HABITACION', 'HABITACION.ID_TIPO_HABITACION', '=', 'TIPO_HABITACION.ID_TIPO_HABITACION')
		->where('HABITACION.ID_HABITACION', '=', $id)
	     ->select('ESTADO_HABITACION.DESCRIPCION AS ESTADO', 'HABITACION.ID_HABITACION AS ID_HABITACION',
			 'TIPO_HABITACION.DESCRIPCION AS DESCRIPCION',
			'HABITACION.DETALLES AS DETALLES', 'HABITACION.ID_TIPO_HABITACION',
			'HABITACION.ID_ESTADO_HABITACION')
	     ->get();
		$tipos=tipoHabitacion::all();
		$estados=EstadoHabitacion::all();
	    return view('nuevasHabitaciones.details',compact('habitaciones', 'tipos', 'estados'));
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
	    $habitaciones->update([
		    'ID_TIPO_HABITACION' => $data['tipo'],
		    'ID_ESTADO_HABITACION'   => $data['estado'],
		    'DETALLES' => $data['description'],
	    ]);
	    return redirect()->route('nuevasHabitaciones');
	}
	public function destroy(nuevaHabitacion $habitacion)
	 {
		try{
			 $habitacion->Delete();
			 return redirect()->route('nuevasHabitaciones');
	    } catch (\Illuminate\Database\QueryException $e)
	    {
			$fallo='Error actualmente esta en uso';
			return redirect('nuevasHabitaciones')->with('fallo', $fallo);
		}
	}
}
