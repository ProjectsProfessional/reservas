<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
    	    $client = Client::all();
    	    $title = 'Listado de Clientes';
    	    return view('clients.index', compact('client','title'));
    	}

    	public function create(){
    	    $title = 'Crear Cliente';
    	    return view('clients.create',compact('title'));
    	}
    	public function details(Client $client){

	   return view('clients.details',compact('client'));
     }

	 public function update(Client $client){
		 $data = request()->all();
		 // dd($data);
		  $client->update([
			  'CODIGO' => $data['codigo'],
			  'NOMBRE1'  => $data['nombre'],
			  'NOMBRE2'  => $data['segundoNombre'],
			  'APELLIDO1'  => $data['primerApellido'],
			  'APELLIDO2'  => $data['segundoApellido'],
			  'TELEFONO'  => $data['telefono'],
			  'EMAIL'  => $data['email'],
			  'TIPO_CLIENTE'  => $data['tipoCliente'],
			  'COMENTARIOS'  => $data['comentarios'],
			  'PATH_SCAN'  => $data['pathScan'],
		  ]);
		 return redirect()->route('clients');
	 }

     public function store(){
             $data = request()->all();
		   //dd($data);
             Client::create([
                 'CODIGO' => $data['code'],
			  'NOMBRE1'  => $data['nombre'],
			  'NOMBRE2'  => $data['segundoNombre'],
			  'APELLIDO1'  => $data['primerApellido'],
			  'APELLIDO2'  => $data['segundoApellido'],
			  'TELEFONO'  => $data['telefono'],
			  'EMAIL'  => $data['email'],
			  'TIPO_CLIENTE'  => $data['tipoCliente'],
			  'COMENTARIOS'  => $data['comentarios'],
			  'PATH_SCAN'  => $data['pathScan'],
             ]);
             return redirect()->route('clients');
     }

}
