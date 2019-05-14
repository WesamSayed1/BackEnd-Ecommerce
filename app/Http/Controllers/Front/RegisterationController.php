<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class RegisterationController extends Controller
{
    public function index()
    {
    	return view('front.Registeration.index');
    }

    public function store(Request $request)
    {
    	 $request->validate([
    		'name'=>'required',
    		'email'=>'required|email',
    		'password'=>'required|confirmed',
    		'address'=>'required'
    	]);

    	$user = User::create([
    		'name'=>$request->name,
    		'email'=>$request->email,
    		'password'=>bcrypt($request->password),
    		'address'=>$request->address
    	]);

    	auth()->login($user);

    	return redirect('/user/profile');
    }
}
