<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;

class DashboardController extends Controller
{
	
    public function index(Product $product , Order $order , User $user){

    	return DashboardResource::collection(Order::paginate(4));
    }
}
