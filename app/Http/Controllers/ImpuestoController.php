<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
         $impuestos = Impuesto::all();
         $title = 'Listado Agregados';
         return view('impuestos.index', compact('impuestos','title'));
     }
     public function create(){
         $title = 'Definir impuesto';
         return view('impuestos.create',compact('title'));
     }
     public function details(Impuesto $impuesto){
 	   // dd($currency);
         return view('impuestos.details',compact('impuesto'));
     }
     public function store(){
         $data = request()->all();
 	   //dd($data);
         Impuesto::create([
             'CODIGO' => $data['code'],
             'TASA'   => $data['tasa'],
         ]);
         return redirect()->route('impuestos');
     }
	public function update(Impuesto $impuesto){
    	 $data = request()->all();
    	  //dd($data);
    	  $impuesto->update([
		  'CODIGO' => $data['code'],
		  'TASA'   => $data['tasa'],
    	  ]);
    	 return redirect()->route('impuestos');
     }
	public function destroy(Impuesto $impuesto)
	 {
		$impuesto->Delete();
		return redirect()->route('impuestos');
	}
}
