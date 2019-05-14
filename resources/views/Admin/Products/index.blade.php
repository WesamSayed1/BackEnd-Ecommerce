@extends('Admin.layouts.master')

@section('page')

View Products

@endsection

@section('content')

				<div class="row">

                    <div class="col-md-12">
                    	@include('Admin.layouts.message')
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Products</h4>
                                <p class="category">List of all stock</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Desc</th>
                                        <th>Tag</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->description}}</td>
                                           <td>
                                            @foreach($product->tags as $tag)
                                            <table class="table">
                                            <tr>
                                                  <td>{{$tag->tag_title}}</td>
                                            </tr>                     
                                           </table>
                                              @endforeach
                                        </td>
                                      
                                       
                                        <td><img src="{{url('/uploads').'/'.$product->image}}"alt="{{$product->image}}" class="img-thumbnail"
                                                 style="width: 50px"></td>
                                        <td>
                                        	{!! Form::open(['route' => ['products.destroy', $product->id] , 'method'=>'DELETE' ])!!}

                                        	{{Form::button('<span class="fa fa-trash"></span>',['type'=>'submit', 'class'=>'btn btn-sm btn-danger','onClick'=>'return confirm("Are You Sure ? ")' ])}}

                                        	{{link_to_route('products.edit','',$product->id,['type'=>'submit', 'class'=>'btn btn-sm btn-info ti-pencil-alt'])}}

                                        	{{link_to_route('products.show','',$product->id,['type'=>'submit', 'class'=>'btn btn-sm btn-primary ti-view-list-alt' ])}}
                                           
                                            {!! Form::close() !!}
                                     	</td>
                                 	</tr>
                                 		@endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

@endsection