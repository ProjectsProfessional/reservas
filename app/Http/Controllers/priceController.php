<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Currency;
use App\Models\price;
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
	    $currencies=Currency::all();
	    $title = 'Definir precio';
	    return view('precio.create',compact('currencies','title'));
	}
	public function details(price $precio){
		$id=$precio->ID_PRECIO;
		$currencies = DB::table('precio')
		   ->join('moneda', 'precio.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
		   ->where('PRECIO.ID_PRECIO', '=', $id)
		   ->select('MONEDA.CODIGO AS CODIGO', 'PRECIO.PRECIO', 'PRECIO.ID_PRECIO')
		   ->get();
         return view('precio.details',compact('id', 'currencies'));
     }

     public function store(){
         $data = request()->all();
         price::create([
             'ID_MONEDA' => $data['moneda'],
             'PRECIO'   => $data['description'],
         ]);
         return redirect()->route('precio');
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
}
