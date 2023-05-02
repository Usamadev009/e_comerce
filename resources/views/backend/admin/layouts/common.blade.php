<html>
@php
  $options = App\Models\Option::first();
  $users = App\Models\User::first();
@endphp
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


            <title>Admin - @yield('title') </title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Google font -->
        <link href="{{url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900')}}" rel="stylesheet">
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="{{url('admin1/css/font-awesome.css')}}">
        <!-- Jquery textEditor -->
        <link rel="stylesheet" href="{{url('admin1/css/jquery-te-1.4.0.css')}}">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="{{url('css/style.css')}}">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        {{-- Summer Note --}}
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

        <!-- Data Tables -->
        <link rel="stylesheet" href="{{asset ('css/jquery.dataTables.min.css')}}">

        <style>
            .select2-container{
                width: 100% !important;
            }
        </style>
    </head>
    <body>
        @section('header')
            <!-- HEADER -->
            <div class="card">
                <div class="card-body">
                    <div id="admin-header">
                        <div class="container-fluid">
                            <div class="row justify-content-between">
                                <div class="col-md-2">

                                    <a href="{{url('dashboard')}}" class="logo-img"><img src="{{ asset($options->site_logo?$options->site_logo:'') }}" alt="logo" height="60px" width="80px"></a>
                                </div>
                                <div class="col-md-offset-8 col-md-2">
                                    <div class="dropdown">
                                        <a href="" class="dropdown-toggle logout" data-toggle="dropdown">
                                            @if(Auth::user()->image)
                                                <img class="img-profile rounded-circle" src="{{ asset(Auth::user()->image) }}" width="45px" height="45px" alt="" />
                                            @else
                                                <img class="img-profile rounded-circle" src="upload/profile.png" width="45px" height="45px" alt="User Image" />
                                            @endif
                                            <span>{{ Auth::user()->name.' '.Auth::user()->lname}}</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li class="ml-2">
                                                <a href="">
                                                    Profile
                                                </a>
                                            </li>
                                            <li class="ml-2">
                                                <a href="{{url('change_password')}}">
                                                    Change Password
                                                </a>
                                            </li>
                                            <li class="ml-2">
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                                                </a>
                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /HEADER -->
        @show

        @section('wraper')
            <div id="admin-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Menu Bar Start -->
                        <div class="col-md-2 col-sm-3" id="admin-menu">
                            <ul class="menu-list">
                                <li class="active">
                                    <a href="{{url('dashboard')}}">
                                        <i class="fa fa-fw fa-tachometer mr-3"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('groups')}}">
                                        <i class="fa fa-object-group mr-3"></i>
                                        Groups
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('category')}}">
                                        <i class="fa fa-sitemap fa-folder mr-3"></i>
                                        Categories
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('subcategory')}}">
                                        <i class="fa fa-list mr-3" aria-hidden="true"></i>
                                        Sub-Categories
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('products')}}">
                                        <i class="fa fa-cubes mr-3"></i>
                                        Products
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('users')}}">
                                        <i class="fa fa-users mr-3"></i>
                                        Users
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('orders')}}">
                                        <i class="fa fa-table mr-3"></i>
                                        Orders
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('options')}}">
                                        <i class="fa fa-image mr-3"></i>
                                        Options
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('banners')}}">
                                        <i class="fa fa-image mr-3"></i>
                                        Banners
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{url('admin/coupon-view')}}">
                                        <i class="fa fa-image mr-3"></i>
                                        Coupons
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Menu Bar End -->
                        <!-- Content Start -->
                        <div class="col-md-10 col-sm-9 clearfix" id="admin-content">
        @show

        <div class="container">
            @yield('content')
        </div>

        @section('footer')
            <div id="admin-footer">
                <span>{{$options->footer_text}}</span>
            </div>

            <script src="{{url('admin1\js\jquery.min.js')}}" type="text/javascript"></script>
            <script src="{{url('admin1\js\popper.min.js')}}" type="text/javascript"></script>
            <script src="{{url('admin1\js\bootstrap.min.js')}}" type="text/javascript"></script>
            <script src="{{url('admin1\js\admin_actions.js')}}" type="text/javascript"></script>
            <script src="{{url('admin1\js\jquery-te-1.4.0.min.js')}}" type="text/javascript"></script>

            {{-- Summer Note --}}
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.select2-products').select2();
                });
            </script>


            <!-- Data Tables-->
            <script type="text/javascript" src="{{url('js/jquery.dataTables.min.js')}}"></script>
            @yield('scripts')
            <!-- https://jqueryte.com/ -->
            <!-- <script>
                $('.product_description').jqte({
                link: false,
                unlink: false,
                color: false,
                source: false,
            });
            </script> -->
        @show


    </body>
</html>
