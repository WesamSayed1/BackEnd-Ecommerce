<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Product;
use App\Tags;

class HomeController extends Controller
{
    public function index(Request $request , Product $products)
    {
    	$data = $request->all();
        $products = new Product();

            //Filter With Tags and Price
         if(!empty($data)){
            $products = $products->where('price','>=', $data['min_price'])
             ->where('price','<=',$data['max_price']);
         }

        if(!empty($data)){
            $products = $products->whereHas('tags',function($query) use ($data) {
                    $query->where('tag_id',$data['tagID']);
            });
        }

        $products = $products->inRandomOrder()->paginate(4);

    	$tags = Tags::with('products')->orderBy('tag_title')->get();
    	
    	return view('front.index',compact('products','tags'));
    }

    public function search(Request $request,Product $products)
    {
        $search = $request->all();

        

        /*if(!empty($search)){
            $products = $products->whereHas('tags',function($query) use ($search){
                $query->where('name','like','%'.$search['search'].'%');
            });
        }*/
          
        if (!is_null($search['search'])) {
            $products = Product::with('tags')->where('name','like','%'.$search['search'].'%')
            ->paginate(4);
        }
        else
        {
            $products = $products->inRandomOrder()->paginate(4);      
        }
    
            
        $tags = Tags::with('products')->orderBy('tag_title')->get();
        return view('front.index',compact('products','tags'));
    }
          


    public function sortby(Request $request,Product $products)
    {
        $search = $request->all();
        
        if($search['sortby'] =='min_price'){
            $products = $products->orderBy('price','asc')->paginate(4);
        }elseif($search['sortby'] == 'max_price'){
            $products = $products->orderBy('price','desc')->paginate(4);
        }elseif($search['sortby']=='latest'){
            $products = $products->orderBy('id','desc')->paginate(4);
        }elseif($search['sortby']=='oldest'){
            $products = $products->orderBy('id','asc')->paginate(4);
        }else{
            $products = $products->inRandomOrder()->paginate(4);
        }
      
        $tags = Tags::with('products')->orderBy('tag_title')->get();
        return view('front.index',compact('products','tags'));
          
    }




 
}

// helw awe tyb dlow2ty l sortby b2a
// bos hwreek btmshy ezay
