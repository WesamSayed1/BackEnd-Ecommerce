<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    
    public function index(Order $orders)
    {
        $orders = Order::all();
        return OrderResource::collection($orders);
    }

    public function confirm($id)
    {
        // find the id
        $order = Order::find($id);
        //update the status
       $status = $order->update(['status'=> 1]);  

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
        return new OrderResource($order);
    }

   

}
