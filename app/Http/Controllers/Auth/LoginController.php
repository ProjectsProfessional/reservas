<?php

namespace App\Http\Controllers\Auth;


//use Validator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>'showLoginForm'
        ]);
    }

    public function showLoginForm(){
        return view('login');
    }

    public function login(){

        $credentials =$this->validate(request(),[
            'email'     => 'email|required|string',
            'password'  => 'required|string',
        ]);

        //dd(Hash::check('321','$2y$10$LNGTm9cmn.myiFd2.O9nE.q9KeZD2F8UFoWqVN50hUwBH9BuxqhOm'));

        if(Auth::attempt($credentials))
            return redirect()->route('welcome');

        return back()
            ->withErrors(['email'=>'credenciales no válidas'])
            ->withInput(request(['email']));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
