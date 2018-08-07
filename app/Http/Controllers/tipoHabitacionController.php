<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\tipoHabitacion;
use App\Models\Impuesto;
use App\Models\Price;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Currency;
use Illuminate\Http\Request;

class tipoHabitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
         $tipos = tipoHabitacion::paginate(10);
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
		$query = DB::table('TIPO_HABITACION')
		->join('PRECIO', 'TIPO_HABITACION.ID_TIPO_HABITACION'
		, '=', 'PRECIO.ID_TIPO_HABITACION')
		->join('MONEDA', 'PRECIO.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
		->join('IMPUESTO', 'PRECIO.ID_IMPUESTO', '=', 'IMPUESTO.ID_IMPUESTO')
		->where('TIPO_HABITACION.ID_TIPO_HABITACION', '=', $id)
		->select('TIPO_HABITACION.ID_TIPO_HABITACION', 'TIPO_HABITACION.DESCRIPCION',
		'PRECIO.PRECIO', 'PRECIO.BRUTO', 'TIPO_HABITACION.ID_TIPO_HABITACION',
		'MONEDA.CODIGO as MONEDA', 'IMPUESTO.ID_IMPUESTO', 'TIPO_HABITACION.PERSONAS as PERSONAS')->first();

		$precios = DB::table('PRECIO')
		->join('MONEDA', 'PRECIO.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
		->where('PRECIO.ID_TIPO_HABITACION', '=', $id)
		->select('PRECIO.PERSONAS as PERSONAS', 'PRECIO.ID_PRECIO AS ID_PRECIO',
		 'PRECIO.PRECIO as PRECIO', 'MONEDA.CODIGO AS CODIGO')->get();
	//	dd($precios);
		$habitacion = tipoHabitacion::findOrFail($id);
		$rows=count($query);
		$impuestos=Impuesto::all();
		$currencies=Currency::all();
		if($rows!=0){
			$habitacion=$query;
			return view('tiposHabitaciones.details', compact('precios', 'habitacion', 'impuestos', 'currencies'));
		}else{
			return view('tiposHabitaciones.details', compact('precios', 'habitacion', 'impuestos', 'currencies'));
		}

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
    public function update(Request $request){
	    //dd($request);
		$data = tipoHabitacion::find( $request->id);
		$data ->DESCRIPCION=$request->description;
		$data ->PERSONAS=$request->personas;
		//dd($data);
		$data->save();
		$arr=$request->precios;
		$id=$request->id;
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
        return response()->json(['success'=>'Actualizado Correctamente']);
    }
    public function destroy(tipoHabitacion $tipo)
	{
		$id=$tipo->ID_TIPO_HABITACION;
		try
		 {
			$query=DB::table('PRECIO')
    		         ->join('TIPO_HABITACION', function ($join) use($id) {
    		             $join->on('TIPO_HABITACION.ID_TIPO_HABITACION', '=', 'PRECIO.ID_TIPO_HABITACION')
	                  ->where('PRECIO.ID_TIPO_HABITACION', '=',$id);
			   })->delete();
    			DB::table('TIPO_HABITACION')->where('ID_TIPO_HABITACION', '=', $id)->delete();
	    		return redirect()->route('tiposHabitaciones');
 	    } catch (\Illuminate\Database\QueryException $e)
	    {
 	    		$fallo='Error actualmente esta en uso';
 			return redirect('tiposHabitaciones')->with('fallo', $fallo);
 		}
    }

}
