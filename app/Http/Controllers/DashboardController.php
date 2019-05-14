<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\User;

class DashboardController extends Controller
{
	
    public function index(Product $product , Order $order , User $user){

    	return view('Admin.dashboard', compact('product','order','user'));
    }
}
