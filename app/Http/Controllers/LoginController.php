<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
	    return view('auth.login');
    }
    public function post(Request $request)
    {
	    dd($request->all());
    }
    public function postLogin(Request $request)
    {
	//dd($request->all());
	Sentinel::authenticate($request->all());
	return Sentinel::check();
    }

}
