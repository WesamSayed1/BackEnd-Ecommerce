
         <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Ecommerce Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    

        <!-- for Search bar by name of product -->

       <div class="col-md-6 ">
        <form class="form-inline my-2 my-lg-0" action="/search" method="get">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="input-group mt-3">
        <form action="/sort" method="get">
            <div class="input-group mb-3">
                <select class="custom-select" name="sortby">
                    <option selected>Sortby...</option>
                    <option value="min_price">Min_Price</option>
                    <option value="max_price">Max_Price</option>
                    <option value="latest">Latest Product</option>
                    <option value="oldest">oldest Product</option>
                    <option value="all">all</option> 
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">SortBy</button>
                </div>
            </div> 
        </form>
        </div>
        </div>

        
    
        <form method="get">
        <!-- Filter with Tags -->
        <div class="row ">
            <div class="input-group mr-5 mb-4">
            <div class="input-group-prepend">
                <button class="btn btn-outline-success" type="submit">Button</button>
            </div>
            <select class="custom-select" name="tagID"  aria-label="Example select with button addon">
                <option selected>Select Tags</option>
                @if(isset($product->tags))
                @foreach($tags as $tag)
                 <option  value="{{$tag->id}}">{{$tag->tag_title}}</option>
                @endforeach
                @endif
            </select>
            </div>
        </div>
            
        
        <div class="input-group ml-3 px-5 mb-3 ">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Min and Max Price</span>
                </div>
                <input type="text" name="min_price" class="form-control">
                <input type="text" name="max_price" class="form-control">        
        </div>
        </div>
        </form>

       
       
    
        <div class="collapse navbar-collapse" id="navbarResponsive">
    
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i> Cart 
                        @if (Cart::instance('default')->count() > 0)
                            <strong>
                                ({{ Cart::instance('default')->count() }})
                            </strong>
                        @endif
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> {{ auth()->check() ? auth()->user()->name : 'Account' }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        @if (!auth()->check())
                            <a class="dropdown-item " href="{{  url('user/login') }}">Sign In</a>
                            <a class="dropdown-item" href="{{  url('user/register') }}">Sign Up</a>
                        @else
                            <a class="dropdown-item" href="{{  url('user/profile') }}"><i class="fa fa-user"></i> Profile</a>
                            <hr>
                            <a class="dropdown-item" href="{{  url('user/logout') }}"><i class="fa fa-lock"></i> Logout</a>
                        @endif
                    </div>
    
                </li>
            </ul>
        </div>
    
    </div>
</nav>
