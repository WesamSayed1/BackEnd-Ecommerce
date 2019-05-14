@extends('front.layouts.master')


@section('content')

  <div class="row">

        <div class="col-md-12" id="register">
			@include('error')
            <div class="card col-md-8">
                <div class="card-body">
					@include('Admin.layouts.message')
                    <h2 class="card-title">Login</h2>
                    <hr>
                    <form action="/user/login" method="POST">
                    	@csrf

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" placeholder="Email" id="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" placeholder="Password" id="passowrd"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-info col-md-2"> Login</button>
                        </div>

                    </form>

                </div>
            </div>


        </div>

    </div>

@endsection