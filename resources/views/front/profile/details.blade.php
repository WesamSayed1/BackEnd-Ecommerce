@extends('front.layouts.master')

@section('content')
<h1>{{$order->user->name}} Profile Details</h1>
<hr>

<div class="row">

	        <div class="col-md-12">
	            
	                    <h4 class="title" colspan="7">Order Details</h4>
	                       <hr>
	                
	                <div class="content table-responsive table-full-width">
	                    <table class="table table-bordered">
	                        <thead>
	                        <tr>
	                            <th>ID</th>
	                            <th>Date</th>
	                            <th>Quantity</th>
	                            <th>Address</th>
	                            <th>Price</th>
	                            <th>Status</th>
	                           
	                        </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                                <td>{{$order->id}}</td>
	                                <td>{{$order->date}}</td>
	                                <td>{{$order->Orderitems[0]->quantity}}</td>
	                                <td>{{$order->address}}</td>
	                                <td>{{$order->products[0]->price}}</td>
	                                <td>
	                                    @if ($order->status)
	                                        <span class="badge badge-success">Confirmed</span>
	                                    @else
	                                        <span class="badge badge-warning">Pending</span>
	                                    @endif
	                                </td>
	                                
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        
	        <div class="col-md-6">
	           
	                    <h4 class="title">User Details</h4>
	                  <hr>
	           
	                <div class="content table-responsive table-full-width">
	                    <table class="table table-bordered">
	                        <thead>
	                        <tr>
	                            <th>ID</th>
	                            <td>{{$order->user->id}}</td>
	                        </tr>
	                        <tr>
	                            <th>Name</th>
	                            <td>{{$order->user->name}}</td>
	                        </tr>
	                        <tr>
	                            <th>Email</th>
	                            <td>{{$order->user->email}}</td>
	                        </tr>
	                        <tr>
	                            <th>Registered At</th>
	                            <td>{{$order->created_at->diffForHumans()}}</td>
	                        </tr>

	                        </thead>
	                    </table>
	                </div>
	            </div>
	        

	        <div class="col-md-12">
	       
	                    <h4 class="title">Product Details</h4>
	                     <hr>
	               
	                <div class="content table-responsive table-full-width">
	                    <table class="table table-bordered">
	                    	
	                       <tr>
	                       	<th>Order ID</th>
	                       	<th>Product Name</th>
	                       	<th>Price</th>
	                       	<th>Quantity</th>
                       		<th>Image</th> 
	                       </tr>

	                        <tr>
	                        	
	                            <td>{{$order->id}}</td>
	                            <td>
                                            @foreach($order->products as $item)
                                            <table class="table">
                                            <tr>
                                            <td>{{$item->name}}</td>
                                            </tr>                     
                                         </table>
                                             @endforeach
	                            </td>

	                            <td>
                                          @foreach($order->OrderItems as $item)
                                            <table class="table">
                                            <tr>
                                            <td>{{$item->price}}</td>
                                            </tr>                     
                                            </table>
                                           @endforeach
	                            </td>

	                             <td>
                                        	@foreach($order->OrderItems as $item)
                                            <table class="table">
                                            <tr>
                                                <td>{{$item->quantity}}</td>
                                            </tr>                     
                                           </table>
                                             @endforeach
                                </td>

                                <td>
                                @foreach($order->products as $item)
                                <table class="table">
                                <tr>
                            		<td><a href="{{ url('uploads/' , $item->image )}}" target="_blank"><img src="{{ url('uploads/',$item->image )}}" alt="{{$order->products[0]->image}}" style="width: 2em"> </a></td>
                                </tr>                     
                               </table>
                                 @endforeach
                              </td>

	                        </tr>

						
	                    </table>

	                </div>
	            </div>
	        </div>
	       

@endsection