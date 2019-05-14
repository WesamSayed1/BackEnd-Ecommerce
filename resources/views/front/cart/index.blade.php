@extends('front.layouts.master')


@section('content')


    <h2 class="mt-5"><i class="fa fa-shopping-cart"></i> Shopping Cart</h2>
    <hr>
	@if(Cart::instance('default')->count() > 0 )
	
    <h4 class="mt-5">{{Cart::instance('default')->count()}} items(s) in Shopping Cart</h4>

    <div class="cart-items">
        
        <div class="row">
        
            <div class="col-md-12">
                    @include('Admin.layouts.message')
                    @if(session()->has('errors'))
                    <div class="alert alert-warning ">
                        {{session()->get('errors')}}
                    </div>
                    @endif
                <table class="table">
                    
                    <tbody>
                        @foreach(Cart::instance('default')->content() as $item)
                        <tr>
                            <td><img src="{{url('/uploads'.'/'. $item->model->image)}}" style="width: 5em"></td>
                            <td>
                                <strong>{{$item->model->name}}</strong><br> {{$item->model->description}}
                            </td>
                            
                            <td>
        						<form action="{{url('/cart/remove'.'/'.$item->rowId)}}" method="POST">
        							@csrf
        							@method('DELETE')
                                <button type="submit" class="btn btn-link btn-link-dark">Remove</button><br>
                                </form>
                                <form  action="{{url('/cart/saveLater'.'/'. $item->rowId)}}" method="POST">

                                	@csrf

                                <button type="submit" class="btn btn-link btn-link-dark">Save For Later</button>

                                </form>

                            </td>
                            
                            <td>
                                <select name="" id="" class="form-control quantity" style="width: 4.7em" data-id="{{$item->rowId}}">
                                    <option {{$item->qty == 1 ? 'selected': ''}}>1</option>
                                    <option {{$item->qty == 2 ? 'selected': ''}}>2</option>
                                    <option {{$item->qty == 3 ? 'selected': ''}}>3</option>
                                    <option {{$item->qty == 4 ? 'selected': ''}}>4</option>
                                    <option {{$item->qty == 5 ? 'selected': ''}}>5</option>
                                </select>
                            </td>
                            
                            <td>${{$item->total()}}</td>
                        </tr>
						@endforeach
                        

                    </tbody>

                </table>

            </div>   
            <!-- Price Details -->
                <div class="col-md-6">
                        <div class="sub-total">
                             <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="2">Price Details</th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>Subtotal </td>
                                        <td>{{Cart::subtotal()}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>{{Cart::tax()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <th>{{Cart::total()}}</th>
                                    </tr>
                             </table>           
                         </div>
                    </div>
                <!-- Save for later  -->
                <div class="col-md-12">
                    <a href="{{url('/')}}" class="btn btn-outline-dark">Continue Shopping</a>
                    <a href="{{url('/checkout')}}" class="btn btn-outline-info">Proceed to checkout</a>
                <hr>

                </div>
                @else
                <h3>There is No Item in Your Cart</h3>
                <a href="{{url('/')}}" class="btn btn-outline-dark">Continue Shopping</a>
                <hr>
				@endif


				@if(Cart::instance('saveForLater')->count() > 0)
                <div class="col-md-12">
                
                <h4>{{Cart::instance('saveForLater')->count()}} items Save for Later</h4>
                <table class="table">
                    
                    <tbody>
                        
                        @foreach(Cart::instance('saveForLater')->content() as $item)
                        <tr>
                            <td><img src="{{url('/uploads'.'/'. $item->model->image)}}" style="width: 5em"></td>
                            <td>
                                <strong>{{$item->model->name}}</strong><br> {{$item->model->description}}
                            </td>
                            
                            <td>
        						<form action="{{route('SaveLater.Destroy',$item->rowId)}}" method="POST">
        							@csrf
        							@method('DELETE')
                                <button type="submit" class="btn btn-link btn-link-dark">Remove</button><br>
                                </form>

                                <form  action="{{route('MoveTo', $item->rowId)}}" method="POST">

                                	@csrf

                                <button type="submit" class="btn btn-link btn-link-dark">move to cart</button>

                                </form>

                            </td>
                            
                            <td>
                                <select name="" id="" class="form-control" style="width: 4.7em">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                            </td>
                            
                            <td>${{$item->total()}}</td>
                        </tr>
						@endforeach

                    </tbody>

                </table>

            	</div> 
           		 @endif 
                </div>


            </div>
        </div>




@endsection

@section('script')

<script src="js\app.js"></script>

<script>
    const className = document.querySelectorAll('.quantity');

    Array.from(className).forEach(function(el){
        el.addEventListener('change',function(){
            const id = el.getAttribute('data-id');
            axios.patch(`/cart/update/${id}`, {
                quantity:this.value
              })
              .then(function (response) {
            //    console.log(response);
                location.reload();
              })
              .catch(function (error) {
                console.log(error);
                
                
              });
        })
    })
</script>

@endsection