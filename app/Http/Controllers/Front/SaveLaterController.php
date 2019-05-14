<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveLaterController extends Controller
{
    public function destroy($id)
    {
    	Cart::instance('saveForLater')->remove($id);

    	return redirect()->back()->with('msg','The Item has been removed form saveForLater ');
    }

    public function MoveToCart($id)
    {
    	$item = Cart::instance('saveForLater')->get($id);

    	Cart::instance('saveForLater')->remove($id);

    	$dubl = Cart::search(function($cartItem, $rowId) use ($id){
    		return $cartItem->id === $id;
    	});

    	if($dubl->isNotEmpty()){
    		return redirect()->back()->with('msg','The Item Already Moved to Your Cart ');
    	}

    	Cart::instance('default')->add($item->id , $item->name,1,$item->price)->associate('App\Product');
    	return redirect()->back()->with('msg','The Item has been Moved To Cart');
    }
}
