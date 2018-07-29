<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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
            //dd($client);
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

    public function isPreferentialCustomer(){
        $data = request()->all();
        $customer = DB::table('CLIENTE')
            ->select('TIPO_CLIENTE')
            ->where('ID_ClIENTE',$data['customer'])
            ->first();

        if ($customer->TIPO_CLIENTE == 'PREF')
            return response()->json(['message'=>true]);

        return response()->json(['message'=>false]);
    }
     public function store(){

        $data = request()->all();
        $lastCustomer = DB::table('CLIENTE')->select(DB::raw('COUNT(1) AS Increment'))->first();

        Client::create([
        'CODIGO' => substr($data['nombre'],0,1).$data['primerApellido'].$lastCustomer->Increment,
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
	public function destroy(Client $client)
	{
		$client->Delete();
		return redirect()->route('clients');
	}
}
