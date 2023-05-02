<html>
@php
  $options = App\Models\Option::first();
  $categories = App\Models\Category::all();
@endphp
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$options->site_title}}- @yield('title') </title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Google font -->
        <link href="{{url('https://fonts.googleapis.com/css?family=Roboto:400,500\,700,900|Montserrat:400,500,700,900')}}" rel="stylesheet">
        <!-- Font Awesome Icon -->
        <link type="text/css" rel="stylesheet" href="{{ url('css/app.css') }}">
        <link rel="stylesheet" href="{{url('css/font-awesome.css')}}">

        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="{{url('css/style.css')}}">

        <!-- Alertify CSS -->
        <link rel="stylesheet" href="{{url('css/alertify.min.css')}}"/>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

        <link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{url('css/owl.theme.default.min.css')}}">

    </head>
    <body>
        @section('header')
            <!--   HEADER   -->
            <div id="header">
                <!--   CONTAINER   -->
                <div class="container">
                    <!--   ROW   -->
                    <div class="row">
                        <!--   LOGO   -->
                        <div class="col-md-2">
                            <a href="#" class="logo-img"><img src="{{ asset($options->site_logo?$options->site_logo:'') }}" alt="logo" height="60px" width="80px"></a>
                        </div>
                        <!--   /LOGO   -->
                        <!--   SEARCH BOX   -->
                        <div class="col-md-7">
                            <form id="search-form" action="{{ url('/searching') }}" method="POST">
                            @csrf
                                <div class="input-group search">
                                    <input type="text" name="search_product" id="search_text" class="form-control" style="border: groove" placeholder="Search for...">
                                    <button type="submit" name="searchbtn" class="input-group-text btn" id="basic-addon2">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    {{-- <span class="input-group-btn">
                                            <input class="btn btn-default"  type="submit" value="Search" />
                                        </span> --}}
                                </div>
                            </form>
                        </div>
                        <!--   /SEARCH BOX   -->
                        <!--   HEADER INFO   -->
                        <div class="col-md-3">
                            <ul class="header-info">
                                <li class="clearfix">
                                    <a href="{{url('/cart')}}">
                                        <i class="fa fa-shopping-cart"></i>
                                        <a class="basket-item-count">
                                            <span class="badge badge-pill"></span>
                                        </a>
                                    </a>
                                </li>
                                @php  $wishlist = App\Models\Wishlist::count(); @endphp
                                <li>
                                    <a href="{{ url('user/wishlist') }}">
                                        <i class="fa fa-heart"></i>
                                        <span class="badge badge-pill">{{ $wishlist }}</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown" href="#" data-toggle="dropdown">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- Authentication Links -->
                                        @guest
                                            <li>
                                                @if (Route::has('login'))
                                                    <li class="nav-item">
                                                        <a data-toggle="modal" data-target="#userLogin_form" href="{{ route('login') }}">
                                                            login
                                                        </a>
                                                        <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                                                    </li>
                                                @endif
                                            </li>
                                            <li>
                                                @if (Route::has('register'))
                                                    <li class="nav-item">
                                                        <a href="{{url('uregister')}}">
                                                            Register
                                                        </a>
                                                        <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                                                    </li>
                                                @endif
                                            </li>
                                            <li>
                                                @else
                                                    <li>
                                                        <a href="{{url('my-profile')}}" class="" >
                                                            My Profile
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url('user_orders')}}" class="" >
                                                            My Orders
                                                        </a>
                                                    </li>
                                                    <li class="dropdown" style="width: 150px">
                                                        <a href="" class="dropdown-toggle logout" data-toggle="dropdown">
                                                            @if(Auth::user()->image)
                                                                <img class="img-profile rounded-circle" src="{{ asset(Auth::user()->image) }}" width="45px" height="45px" alt="" />
                                                            @else
                                                                <img class="img-profile rounded-circle" src="upload/profile.png" width="45px" height="45px" alt="User Image" />
                                                            @endif
                                                            {{ Auth::user()->name.' '.Auth::user()->lname}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                                            @csrf
                                                                <input type="submit" name="Logout" class="btn" value="Logout" style="background-color:darkcyan;width:100%;"/>
                                                        </form>
                                                    </li>
                                            </li>
                                        @endguest
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <!--   HEADER INFO   -->
                        <!--   MODAL   -->
                        <div class="modal fade" id="userLogin_form" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                    <div class="modal-body">
                                        <!-- Form -->
                                        <form method="POST" action="{{ route('user_login') }}">
                                            @csrf
                                                <div class="customer_login">
                                                    <h2>login here</h2>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6 offset-md-4" style="margin-left: -3px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="margin-left:20px;margin-top: 17px;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="remember">
                                                                    {{ __('Remember Me') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="submit" name="login" class="btn" value="login"/>
                                                    <span>Don't Have an Account <a href="{{url('uregister')}}">Register</a></span>
                                                </div>
                                        </form>
                                        <!-- /Form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--   /MODAL   -->
                    </div>
                    <!--   /ROW   -->
                </div>
                <!--   /CONTAINER   -->
            </div>
            <!--   /HEADER   -->

        @show
            @section('header menu')
                <!--   HEADER MENU   -->
                <div id="header-menu">
                    <div class="dropdown show menu-list">
                        @php
                            $group=App\Models\Group::where('status','!=','2')->get();
                            $categorie=App\Models\Category::where('status','!=','2')->get();
                        @endphp
                        <li>
                            <a class="btn btn-secondary" style="background-color : rgba(255,255,255,0.1);text-transform: uppercase;font-size: 15px;    font-weight: 600;" href="{{url('/')}}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-secondary dropdown-toggle" style="background-color : rgba(255,255,255,0.1);text-transform: uppercase;font-size: 15px;font-weight: 600;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                All Groups
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach ($group as $group_nav_item)
                                    <a class="dropdown-item" href="{{ url('collection/'.$group_nav_item->url) }}">{{$group_nav_item->name}}</a>
                                @endforeach
                            </div>
                        </li>
                        <li>
                            <a class="btn btn-secondary dropdown-toggle" style="background-color : rgba(255,255,255,0.1);text-transform: uppercase;font-size: 15px;font-weight: 600;" href="#" role="button" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                All Categories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                                @foreach ($categorie as $cat_item)
                                    <a class="dropdown-item" href="{{ url('collection/'.$cat_item->group->url.'/'.$cat_item->url) }}">{{$cat_item->name}}</a>
                                @endforeach
                            </div>
                        </li>
                    </div>
                </div>
                <!--   /HEADER MENU   -->
        @show

        <div class="container-fluid">
            @yield('content')
        </div>

        @section('footer')
            <div id ="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>{{$options->site_name}}</h3>
                            <p>{{$options->site_desc}}</p>
                        </div>
                        <div class="col-md-4">
                            <h3>Useful Links</h3>
                                <ul class="menu-list">
                                    <li>
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('new-arrival') }}">New Products</a>
                                    </li>
                                    <li>
                                        <a href="{{url('popular-products')}}">Popular Products</a>
                                    </li>
                                    <li>
                                        <a href="{{url('featured-products')}}">Featured Products</a>
                                    </li>
                                    <li>
                                        <a href="{{url('all-products')}}">All Products</a>
                                    </li>
                                </ul>
                        </div>
                        <div class="col-md-4">
                            <h3>Contact Us</h3>
                            <ul class="menu-list">
                                <li><i class="fa fa-home" ></i><span>{{$options->contact_address}}</span></li>
                                <li><i class="fa fa-phone" ></i><span>{{$options->contact_phone}}</span></li>
                                <li><i class="fa fa-envelope" ></i><span>{{$options->contact_email}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <ul class="social-icon">
                                <li>
                                    <a href="https://web.facebook.com/">
                                        <i class="fa fa-facebook-official"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://accounts.snapchat.com">
                                        <i class="fa fa-snapchat"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-pinterest-p"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/login">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span><a href="#" target="_blank">{{$options->footer_text}}</a></span>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="{{url('js\jquery-1.10.2.min.js')}}"></script>
            <script type="text/javascript" src="{{url('js\popper.min.js')}}"></script>
            <script type="text/javascript" src="{{url('js\bootstrap.min.js')}}"></script>
            <script type="text/javascript" src="{{url('js\actions.js')}}"></script>

            {{-- AutoComplete --}}
            <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
            <script>
                $(document).ready(function () {
                    scr = "{{ route('searchproductajax') }}";
                    $( "#search_text" ).autocomplete({
                        source: function(request, response){
                            $.ajax({
                                url: scr,
                                data: {
                                    term: request.term
                                },
                                dataType: "json",
                                success: function(data) {
                                    response(data);
                                }
                            });
                        },
                        minLength: 1,
                    });

                    $(document).on('click', '.ui-menu-item', function () {
                        $('#search-form').submit();
                    });

                });
            </script>

            {{-- Custom Js  --}}
            <script type="text/javascript" src="{{url('js\custom.js')}}"></script>
            <!-- Alertify JS -->
            <script type="text/javascript" src="{{url('js\alertify.min.js')}}"></script>
            <script>
                @error('email')
                    $('#userLogin_form').modal('show');
                @enderror
                @if (session('status'))
                    alertify.set('notifier','position','top-right');
                    alertify.success("{{ session('status') }}");
                @endif
            </script>

            <!--owl carousel plugin-->
            <script type="text/javascript" src="{{url('js/owl.carousel.js')}}"></script>

            <script>
                $(document).ready(function(){
                    $('.new-carousel').owlCarousel({
                        loop: true,
                        margin: 0,
                        responsiveClass: true,
                        navText : ["",""],
                        responsive: {
                            0: {
                                items: 1,
                                nav: true

                            },
                            600: {
                                items: 2,
                                nav: true
                            },
                            800: {
                                items: 3,
                                nav: true
                            },
                            1000: {
                                items: 4,
                                nav: true,
                                loop: false,
                                margin: 5
                            }
                        }
                    });

                    $('.popular-carousel').owlCarousel({
                        loop: true,
                        margin: 0,
                        responsiveClass: true,
                        navText : ["",""],
                        responsive: {
                            0: {
                            items: 1,
                            nav: true
                            },
                            600: {
                            items: 2,
                            nav: true
                            },
                            800: {
                                items: 4,
                                nav: true
                            },
                            1000: {
                                items: 5,
                                nav: true,
                                loop: false,
                                margin: 10
                            }
                        }
                    });

                    $('.featured-carousel').owlCarousel({
                        loop: true,
                        margin: 0,
                        responsiveClass: true,
                        navText : ["",""],
                        responsive: {
                            0: {
                                items: 1,
                                nav: true

                            },
                            600: {
                                items: 2,
                                nav: true
                            },
                            800: {
                                items: 3,
                                nav: true
                            },
                            1000: {
                                items: 5,
                                nav: true,
                                loop: false,
                                margin: 5
                            }
                        }
                    });
                });

            </script>
        @show

        @yield('script')
    </body>
</html>
