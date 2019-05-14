<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
    	return view('front.cart.index');
    }

    public function store(Request $request)
    {
        if(!auth()->user()){
            return redirect('/user/login');
        }
    	$dubl = Cart::search(function($cartItem, $rowId) use ($request){
    		return $cartItem->id === $request->id;
    	});

    	if($dubl->isNotEmpty()){
    		return redirect()->back()->with('msg','The Item Already Added In Your Cart Once');
    	}
    	Cart::add($request->id,$request->name,1,$request->price)->associate('App\Product');

    	return redirect()->back()->with('msg','The Item Added to The Cart');
    }

    public function destroy($id)
    {
    	Cart::remove($id);

    	return redirect()->back()->with('msg','The Item has been deleted form Cart');
    }

    public function SaveLater($id)
    {
    	$item = Cart::get($id);

    	Cart::remove($id);

    	$dubl = Cart::instance('saveForLater')->search(function($cartItem, $rowId) use ($id){
    		return $cartItem->id === $id;
    	});

    	if($dubl->isNotEmpty()){
    		return redirect()->back()->with('msg','The Item Already Saved For later In Your Cart Once');
    	}

    	Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Product');

    	return redirect()->back()->with('msg','The Item has been Saved For Later');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'quantity'=>'required|numeric|between: 1,5'
        ]);

        if($validator->fails()){
            session()->flash('errors','The Quantity Must be Between 1 to 5');
            return response()->json(['success'=> false]);
        }
        //update the quantity 
        Cart::update($id, $request->quantity);
        session()->flash('msg','The Quantity has been Updated');
        return response()->json(['success'=> true]);
    }
}
