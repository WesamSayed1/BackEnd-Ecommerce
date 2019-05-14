@extends('front.layouts.master')


@section('content')

<h1>{{$user->name}} Profile </h1>

<hr>

<h3>User Details</h3>

<table class="table table-borderless">
  <thead>
    	<tr>
    		<th colspan="2">User Details<a href="" class="pull-right">Edit User<i class="fa fa-cogs"></i></a></th>
    	</tr>	
     
  </thead>
  <tbody>
  	<tr>
  	 <th scope="col">ID</th>
      <th scope="col">{{$user->id}}</th>
      
    </tr>
    <tr>
      <th scope="row">Name</th>
      <td>{{$user->name}}</td>
      
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td>{{$user->email}}</td>
      
    </tr>
    <tr>
      <th scope="row">Registered at</th>
      <td>{{$user->created_at->diffForHumans()}}</td>
    </tr>
  </tbody>
</table>

  <div class="row">

                    <div class="col-md-12">
                    	@include('Admin.layouts.message')
                        
                          
                                <h4 class="title">Orders</h4>
                                
                           
                            <div class="content table-responsive table-full-width">
                                <table class="table table-bordered	">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                      
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    	  @foreach($user->orders as $order)


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
                                           @endforeach
                                         </td>
                                         
                                        
                                        <td>
                                          	@if($order->status)
                                            <span class="badge badge-success">Confirmed</span>
                                            @else
                                            <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                      		
                                           {{link_to_route('user.show','Details', $order->id ,['class'=>'btn btn-outline btn-sm'])}}
                                        </td>
                                    </tr>
										@endforeach
                                   </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>


@endsection