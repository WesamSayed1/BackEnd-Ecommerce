@extends('Admin.layouts.master')

@section('page')

Add Product

@endsection


@section('content')
	

 				<div class="row">
                    <div class="col-lg-10 col-md-10">
                    	@include('Admin.layouts.message')
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add Product</h4>
                            </div>
                            <div class="content">
                                    <script>
    $('select').selectpicker();

    
</script>
         
                                {!! Form::open(['url' => 'admin/products', 'files'=> true]) !!}
                                  	@include('Admin.Products._fields')
                                    <div class="form-group">
                                    	{{Form::submit('Add Product', ['class'=>'btn btn-info btn-fill btn-wdt'])}}
                                    </div>
                                    <div class="clearfix"></div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

@endsection