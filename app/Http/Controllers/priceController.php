<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Impuesto;
use Illuminate\Support\Collection;
use App\Models\Currency;
use App\Models\price;
use App\Models\tipoHabitacion;
use Illuminate\Http\Request;

class priceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
	    $precios = price::all();
	    $currencies = DB::table('precio')
            ->join('moneda', 'precio.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
            ->select('MONEDA.CODIGO AS CODIGO', 'PRECIO.PRECIO', 'PRECIO.ID_PRECIO')
		  ->orderBy('PRECIO.ID_PRECIO')
            ->get();
	//	$currencies = Currency::all();
	    $title = 'Listado de Precios';
	    return view('precio.index', compact('precios','title', 'currencies'));
	}
	public function create(){
	    $title = 'Definir precio';
	    $impuestos=Impuesto::all();
		$currencies=Currency::all();
	    return view('price.create',compact('impuestos','currencies','title'));
	}
	public function details(price $p){
		$id=$p->ID_PRECIO;
	//	dd($id);
		$precios = DB::table('precio')
		   ->join('MONEDA', 'precio.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
		   ->join('IMPUESTO', 'IMPUESTO.ID_IMPUESTO', '=', 'PRECIO.ID_IMPUESTO')
		   ->where('PRECIO.ID_PRECIO', '=', $id)
		   ->select('MONEDA.CODIGO AS CODIGO', 'PRECIO.PRECIO AS PRECIO',
		    'PRECIO.ID_PRECIO', 'PRECIO.ID_MONEDA', 'PRECIO.ID_TIPO_HABITACION',
		    'PRECIO.ID_IMPUESTO', 'PRECIO.BRUTO', 'IMPUESTO.CODIGO AS IMPUESTO')
		   ->get();
	//	   dd($precios, $id);
         return view('precio.details',compact('id', 'precios'));
     }

     public function store(request $request){
	         $data = request()->all();
		    $ID_MONEDA = $request->input('moneda');
		    $precio = $request->input('price');
		    $ID_IMPUESTO= $request->input('impuesto');
		    $BRUTO= $request->input('grossTotal');
		    $push=[$ID_MONEDA,$precio,$ID_IMPUESTO,$BRUTO];
		    $collection = collect($push);
		    $collection->push($push);
		    $collection->all();
		    dd($collection);
         return redirect()->route('tiposHabitaciones');
     }
	public function update(Price $precio){
	   $data = request()->all();
	    //dd($data);
	    $precio->update([
		    'ID_MONEDA' => $data['code'],
              'PRECIO'   => $data['precio'],
	    ]);
	   return redirect()->route('precio');
	}
	public function destroy(Price $p)
 	{
 		$id=$p->ID_PRECIO;
		//dd($id);
 		try{
			$query=DB::table('PRECIO')
			    ->join('TIPO_HABITACION', function ($join) use($id) {
				   $join->on('TIPO_HABITACION.ID_TIPO_HABITACION', '=', 'PRECIO.ID_TIPO_HABITACION')
				   ->where('PRECIO.ID_TIPO_HABITACION', '=',$id);
			    })->get();
    			 DB::table('PRECIO')->where('ID_PRECIO', '=', $id)->delete();
 	    		return redirect()->route('tiposHabitaciones');
  	    } catch (\Illuminate\Database\QueryException $e)
 	    {
  	    		$fallo='Error actualmente esta en uso';
  			return redirect('tiposHabitaciones')->with('fallo', $fallo);
  		}
		return "Error";
     }
}
