<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
   
    public function index(Product $products)
    {
        $tags = Tags::all();
        $products = Product::all();
        return ProductResource::collection($products,$tags);
    }

    
    public function create(Product $product)
    {
        $tags = Tags::all();
        return view('Admin.Products.create' , compact('product','tags'));
    }

    public function store(Request $request , Product $product)
    {
        $attributes = $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'image'=>'image|required'
        ]);

         if($request->hasFile('image')){
             $image = $request->image;
             $image->move('uploads', $image->getClientOriginalName());
         }
       

        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$request->image->getClientOriginalName(),
            
        ]);
        $product_tags = $request->product_tags;
         $product->tags()->attach($product_tags);
       

        return response()->json([
            'status' => (bool) $product,
            'data'   => $product,
            'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);

        // session()->flash('msg','The Product has been Created');

        //  return redirect('admin/products/create');
    }

   
    public function show(Product $product)
    {
        $tags = Tags::all();
                                 
        // return view('Admin.products.details', compact('product','tags'));
        return new ProductResource($product);
    }

    public function edit(Product $product)
    {
        $tags = Tags::all();

        return view('Admin.Products.edit', compact('product','tags'));
    }

    public function update(Request $request, Product $product)
    {
        // $attributes = $request->validate([
        //     'name'=>'required',
        //     'price'=>'required',
        //     'description'=>'required',
        //     'image'=>'image|required'
        // ]);

        if($request->hasFile('image')){
            if(file_exists(public_path('uploads/').$product->image)){
                unlink(public_path('uploads/').$product->image);
            }
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
            $product->image =  $request->image->getClientOriginalName();
        }

       $product->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$product->image
        ]);
        $product_tags = $request->product_tags;
        $product->tags()->attach($product_tags);

        return response()->json([
            'status' => $product,
            // 'data' => new ProductResource('product'),
            'message' => $product ? 'Product Updated!' : 'Error Creating Product'
        ]);

        // session()->flash('msg','Your Product Has been Updated');

        // return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       $status = $product->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);

        // session()->flash('msg','The Product Has been Deleted!!');

        // return redirect('admin/products');
    }
}
