@extends('Admin.layouts.master')

@section('page')

User Order Details

@endsection

@section('content')

	<div class="row">

	        <div class="col-md-12">
	            <div class="card">
	                <div class="header">
	                    <h4 class="title">{{$user->name}} Order Details</h4>
	                    <p class="category">Order details</p>
	                </div>
	                <div class="content table-responsive table-full-width">
	                    <table class="table table-striped">
	                        <thead>
	                        <tr>
	                            <th>Order ID</th>
	                            <th>Product Name</th>
	                            <th>Quantity</th>
	                            <th>Total Price</th>
	                            <th>Status</th>
	                            
	                        </tr>
	                        </thead>
	                        <tbody>
	                        	<tr>
	                        	@foreach($orders as $order)
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
                                                <td>{{$item->quantity}}</td>
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
                                		 @endforeach</td>
	                                <td>
	                                	
	                                    @if ($order->status)
	                                        <span class="label label-success">Confirmed</span>
	                                    @else
	                                        <span class="label label-warning">Pending</span>
	                                    @endif
	                                </td>
	                               
	                            </tr>
	                            @endforeach
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	       
	             

	                </div>
	     
	   


@endsection