<?php

namespace App\Http\Controllers;

use App\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->Middleware('guest:admin')->except('logout');
    }
    
    public function index()
    {
        return view('Admin.login');
    }

    

    
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        $credentials = $request->only('email','password');
        if(!Auth::guard('admin')->attempt($credentials)){
            return back()->withErrors([
                'message'=>'Wrong Credintials Please Try Again'
            ]);

        }

        session()->flash('msg', 'You Have been Logged In');

        return redirect('/admin');
    }

    
    public function logout( )
    {
        auth()->guard('admin')->logout();

        session()->flash('msg', 'You Have been Successfully Logged out');

        return redirect('/admin/login');

    }

   
}
