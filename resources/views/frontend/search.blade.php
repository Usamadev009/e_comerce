@extends('layouts.common')

@section('title', 'Search')

@section('header')
    @parent
@endsection
@section('content')
    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">Search Results</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 left-sidebar">
                    <h3>Related Categories</h3>
                    <ul>
                        <li>
                            <a href="{{url('category')}}"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="col-md-3 col-sm-6">
                        <div class="product-grid">
                            <div class="product-image">
                                <a class="image" href="{{url('single_product')}}">
                                    <img class="pic-1" src="product-images/1598963469particle-board.JPEG">
                                </a>
                                <div class="product-button-group">
                                    <a href="{{url('single_product')}}"><i class="fa fa-eye"></i></a>
                                    <a href="" class="add-to-cart" data-id=""><i class="fa fa-shopping-cart"></i></a>
                                    <a href="" class="add-to-wishlist" data-id=""><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3 class="title">
                                    <a href="{{url('single_product')}}">Delite Kom Riley Engineered Wood Bedside Table (Finish Color - Acacia Dark)</a>
                                </h3>
                                <div class="price">Rs. 2750</div>
                            </div>
                        </div>
                    </div>
                   <!--  <div class="empty-result">!!! Result Not Found !!!</div> -->
                        <div class="pagination-outer">
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection