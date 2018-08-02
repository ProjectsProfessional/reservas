<?php

namespace App\Http\Controllers;

use App\Models\fuenteReserva;
use Illuminate\Http\Request;

class fuenteReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
    	    $fuentes = fuenteReserva::paginate(10);
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
	public function destroy(fuenteReserva $fuente)
	 {
		try{
			$fuente->Delete();
			return redirect()->route('fuentes');
	    } catch (\Illuminate\Database\QueryException $e)
	    {
			$fallo='Error actualmente esta en uso';
			return redirect('fuentes')->with('fallo', $fallo);
		}
	}
}
