@extends('layouts.common')

@section('title', '')

@section('header')
    @parent
@endsection


@section('content')
    <div id="banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-content">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($banners as $key => $banner )
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach( $banners as $key => $banner )
                                    <div class="carousel-item test {{ $key == 0 ? 'active' : '' }}">
                                        <img class="d-block img-fluid" src="{{ $banner->photo }}" alt="{{$banner->photo }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($newproducts)!=0)
        <div class="product-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-head">New Products
                            <a href="{{ url('new-arrival') }}" class="btn btn-primary" style="float: right">View All</a>
                        </h2>
                        <div class="new-carousel owl-carousel owl-theme">
                            @foreach($newproducts as $newproduct)
                                <div class="product-grid latest item">
                                    <div class="product-image new">
                                        <a class="image" href="{{ url('collection/'.$newproduct->subcategory->category->group->url.'/'.$newproduct->subcategory->category->url.'/'. $newproduct->subcategory->url.'/'.$newproduct->url) }}">
                                            <span class="notify-badge">{{$newproduct->sale_tag}}</span>
                                            <img class="pic-1"  src="{{ asset($newproduct->image) }}">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="{{ url('collection/'.$newproduct->subcategory->category->group->url.'/'.$newproduct->subcategory->category->url.'/'. $newproduct->subcategory->url.'/'.$newproduct->url) }}" ><i class="fa fa-eye"></i></a>
                                            {{-- <a href="" type="button" class="add-to-cart-btn" data-id=""><i class="fa fa-shopping-cart"></i></a> --}}
                                            {{-- <a href="" class="add-to-wishlist" data-id=""><i class="fa fa-heart"></i></a> --}}
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="{{ url('collection/'.$newproduct->subcategory->category->group->url.'/'.$newproduct->subcategory->category->url.'/'. $newproduct->subcategory->url.'/'.$newproduct->url) }}">{{$newproduct->name}}</a>
                                        </h3>
                                        <div class="price">
                                            <span class="font-italic mr-2"> <s>Rs: {{ $newproduct->original_price }}</s> </span>
                                            <span class="font-weight-bold">Rs: {{ $newproduct->offer_price }} </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(count($popularproducts)!=0)
        <div class="product-section popular-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-head">Popular Products
                            <a href="{{ url('popular-products') }}" class="btn btn-primary" style="float: right">View All</a>
                        </h2>
                        <div class="popular-carousel owl-carousel owl-theme">
                        @foreach($popularproducts as $popproduct)
                            <div class="product-grid latest item">
                                <div class="product-image popular">
                                    <a class="image" href="{{ url('collection/'.$popproduct->subcategory->category->group->url.'/'.$popproduct->subcategory->category->url.'/'. $popproduct->subcategory->url.'/'.$popproduct->url) }}">
                                        <img class="pic-1"  src="{{ asset($popproduct->image) }}">
                                    </a>
                                    <div class="product-button-group">
                                        <a href="{{ url('collection/'.$popproduct->subcategory->category->group->url.'/'.$popproduct->subcategory->category->url.'/'. $popproduct->subcategory->url.'/'.$popproduct->url) }}" ><i class="fa fa-eye"></i></a>
                                        {{-- <a href="" class="" data-id=""><i class="fa fa-shopping-cart"></i></a>
                                        <a href="" class="add-to-wishlist" data-id=""><i class="fa fa-heart"></i></a> --}}
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">
                                        <a href="{{ url('collection/'.$popproduct->subcategory->category->group->url.'/'.$popproduct->subcategory->category->url.'/'. $popproduct->subcategory->url.'/'.$popproduct->url) }}">{{$popproduct->name}}</a>
                                    </h3>
                                    <div class="price">{{$popproduct->original_price}}</div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(count($featuredproducts)!=0)
        <div class="product-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-head">Featured Products
                            <a href="{{ url('featured-products') }}" class="btn btn-primary" style="float: right">View All</a>
                        </h2>
                        <div class="featured-carousel owl-carousel owl-theme">
                            @foreach($featuredproducts as $fetproduct)
                                <div class="product-grid featured item">
                                    <div class="product-image popular">
                                        <a class="image" href="{{ url('collection/'.$fetproduct->subcategory->category->group->url.'/'.$fetproduct->subcategory->category->url.'/'. $fetproduct->subcategory->url.'/'.$fetproduct->url) }}">
                                            <img class="pic-1"  src="{{ asset($fetproduct->image) }}">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="{{ url('collection/'.$fetproduct->subcategory->category->group->url.'/'.$fetproduct->subcategory->category->url.'/'. $fetproduct->subcategory->url.'/'.$fetproduct->url) }}" ><i class="fa fa-eye"></i></a>
                                            {{-- <a href="" class="add-to-cart" data-id=""><i class="fa fa-shopping-cart"></i></a>
                                            <a href="" class="add-to-wishlist" data-id=""><i class="fa fa-heart"></i></a> --}}
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="{{ url('collection/'.$fetproduct->subcategory->category->group->url.'/'.$fetproduct->subcategory->category->url.'/'. $fetproduct->subcategory->url.'/'.$fetproduct->url) }}">{{$fetproduct->name}}</a>
                                        </h3>
                                        <div class="price">{{$fetproduct->original_price}}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(count($offerproducts)!=0)
    <div class="product-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">Offer Products
                        <a href="{{ url('offer-products') }}" class="btn btn-primary" style="float: right">View All</a>
                    </h2>
                    <div class="featured-carousel owl-carousel owl-theme">
                        @foreach($offerproducts as $offproduct)
                            <div class="product-grid featured item">
                                <div class="product-image popular">
                                    <a class="image" href="{{ url('collection/'.$offproduct->subcategory->category->group->url.'/'.$offproduct->subcategory->category->url.'/'. $offproduct->subcategory->url.'/'.$offproduct->url) }}">
                                        <img class="pic-1"  src="{{ asset($offproduct->image) }}">
                                    </a>
                                    <div class="product-button-group">
                                        <a href="{{ url('collection/'.$offproduct->subcategory->category->group->url.'/'.$offproduct->subcategory->category->url.'/'. $offproduct->subcategory->url.'/'.$offproduct->url) }}" ><i class="fa fa-eye"></i></a>
                                        {{-- <a href="" class="add-to-cart" data-id=""><i class="fa fa-shopping-cart"></i></a>
                                        <a href="" class="add-to-wishlist" data-id=""><i class="fa fa-heart"></i></a> --}}
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">
                                        <a href="{{ url('collection/'.$offproduct->subcategory->category->group->url.'/'.$offproduct->subcategory->category->url.'/'. $offproduct->subcategory->url.'/'.$offproduct->url) }}">{{$offproduct->name}}</a>
                                    </h3>
                                    <div class="price">{{$offproduct->original_price}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
