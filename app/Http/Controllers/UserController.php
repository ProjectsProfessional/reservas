<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users = User::all();
        $title = 'Listado de Usuarios';

        return view('users.index',compact('users','title'));
    }
    public function create(){
        return view('users.create');
    }

    public function details(User $user){
        return view('users.details',compact('user'));
    }
    public function store(){
        $data = request()->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        return redirect()->route('users');
    }
}
