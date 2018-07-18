<?php

namespace App\Http\Controllers;

use App\Models\fuenteReserva;
use Illuminate\Http\Request;

class fuenteReservaController extends Controller
{
	public function index(){
    	    $fuentes = fuenteReserva::all();
    	    $title = 'Fuentes de reserva';
    	    return view('fuentes.index', compact('fuentes','title'));
        }
        public function create(){
    	   $title = 'Definir fuente de reserva';
    	   return view('fuentes.create',compact('title'));
        }
        public function details(fuenteReserva $fuente){
    	   return view('fuentes.details',compact('fuente'));
        }
	   public function store(){
            $data = request()->all();
    	   //dd($data);
            fuenteReserva::create([
                'CODIGO' => $data['code'],
                'DESCRIPCION'   => $data['description'],
            ]);
            return redirect()->route('fuentes');
        }
        public function update(fuenteReserva $fuente){
    	    $data = request()->all();
     	   	//dd($data);
    		$fuente->update([
    			'CODIGO' => $data['code'],
                   'DESCRIPCION'   => $data['description'],
    		]);
    	    return redirect()->route('fuentes');
        }
}
