<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index(Order $orders)
    {
        $orders = Order::all();
        return view('Admin.Orders.index', compact('orders'));
    }

    public function confirm($id)
    {
        // find the id
        $order = Order::find($id);
        //update the status
        $order->update(['status'=> 1]);  

        session()->flash('msg','The Order has been Confirmed');

        return redirect('admin/orders');
    }

    public function pending($id)
    {
        $order = Order::find($id);
        $order->update(['status'=> 0]);  

        session()->flash('msg','The Order Again has been Pending');

        return redirect('admin/orders');
        
    }

    public function show(Order $order)
    {
        return view('Admin.Orders.details', compact('order'));
    }

   

}
