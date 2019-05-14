<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

    public function index()
    {
    	return view('front.sessions.index');
    }

    public function store(Request $request)
    {
    	 $request->validate([
    		'email'=>'required|email',
    		'password'=>'required'
    		 ]);

    	$data = Request(['email','password']);

    	if(!auth()->attempt($data)){
    		return back()->withErrors([
    			'message'=>'Wrong Credintials Pleas Try Again'
    		]);
    	}

    	return redirect('/user/profile');
    }

    public function logout( )
    {
        auth()->logout();

        session()->flash('msg', 'You Have been Successfully Logged out');

        return redirect('/user/login');

    }
}
