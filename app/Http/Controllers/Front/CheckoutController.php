<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Config;
use App\Order;
use App\OrderItems;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

      public function index()
    {
    	return view('front.checkout.index');
    }

    public function store(Request $request, Order $order)
    {
/*
    	dd($request->all());*/
        $contents = Cart::instance('default')->content()->map(function($item){
                return $item->model->name . ' ' . $item->qty;
            })->values()->toJson();
    	try {
    		
			

    		Stripe::charges()->create([
    			'amount'=> Cart::total(),
    			'currency'=>'USD',
    			'source'=>$request->stripeToken,
    			'description'=>'some of text',
    			'metadata'=>[
    				 'contents'=>$contents,
    				 'quantity'=>Cart::instance('default')->count(),
    			],
    		
    		]);

            // insert into Order table
            $order = Order::create([
                'user_id'=>auth()->user()->id,
                'date'=>Carbon::now(),
                'address'=>$request->address,
                'status'=>0

            ]);

            //insert into ItemOrder table

            foreach (Cart::instance('default')->content() as $item ) {
                OrderItems::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item->model->id,
                    'quantity'=>$item->qty,
                    'price'=>$item->price
                ]);
            }



    	Cart::instance('default')->destroy();
    		
    	return redirect()->back()->with('msg','Success Thank you');	
    	
    	} catch (Exception $e) {
    		
    	}
    }
}
