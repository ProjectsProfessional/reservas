<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\tipoHabitacion;
use App\Models\Impuesto;
use App\Models\Price;
use App\Models\Currency;
use Illuminate\Http\Request;

class tipoHabitacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
	//Variable tipos va hacia el index
        $tipos = tipoHabitacion::all();
 	    $title = 'Listado';
 	    return view('tiposHabitaciones.index', compact('tipos','title'));
     }

    public function create(){
        $title = 'Definir habitacion';
        $impuestos=Impuesto::all();
	   $currencies=Currency::all();
        return view('tiposHabitaciones.create',compact('currencies','impuestos','title'));
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
     public function store(request $request){
		$this->validate($request,[
			'description' => 'required',
			'personas' => 'required',
		]);
        $tipo = new tipoHabitacion();
        $tipo->DESCRIPCION = $request->description;
        $tipo->PERSONAS = $request->personas;
        $tipo->save();

        $id=$tipo->ID_TIPO_HABITACION;
        $arr=$request->precios;

        for ($i=0; $i <count($arr) ; $i++) {
            $precio[$i]= new Price();
            $precio[$i]->ID_MONEDA=$request->precios[$i]["moneda"];
            $precio[$i]->ID_IMPUESTO=$request->precios[$i]["impuesto"];
            $precio[$i]->BRUTO=$request->precios[$i]["gross"];
            $precio[$i]->PERSONAS=$request->precios[$i]["personas"];
            $precio[$i]->PRECIO=$request->precios[$i]["price"];
            $precio[$i]->ID_TIPO_HABITACION=$id;
            $precio[$i]->save();
        }
        return response()->json(['success'=>'Tipo de habitación '.$tipo->DESCRIPCION.' Creado Correctamente']);
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
    public function destroy(tipoHabitacion $tipo)
	{
		$id=$tipo->ID_TIPO_HABITACION;
		try {
			$query=DB::table('PRECIO')
    		         ->join('TIPO_HABITACION', function ($join) use($id) {
    		             $join->on('TIPO_HABITACION.ID_TIPO_HABITACION', '=', 'PRECIO.ID_TIPO_HABITACION')
	                  ->where('PRECIO.ID_TIPO_HABITACION', '=',$id);
    		         })
    		         ->get();
    		//dd(count($query));
    		DB::table('TIPO_HABITACION')->where('ID_TIPO_HABITACION', '=', $id)->delete();
	    return redirect()->route('tiposHabitaciones');
 	    } catch (\Illuminate\Database\QueryException $e) {
 	    		$fallo='Error actualmente esta en uso';
 			return redirect('tiposHabitaciones')->with('fallo', $fallo);
 		}

    }
}
