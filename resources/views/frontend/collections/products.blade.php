@extends('layouts.common')

@section('title', 'Category - SubCategory - Products')

@section('header')
    @parent
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="section-head mb-1">Collection / {{$subcategory->category->group->name}} / {{$subcategory->category->name}} / {{$subcategory->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-mb-12 mb-3 ml-3 ">
                <div class="card">
                    <div class="card-body">
                        <span class="font-weight-bold sort-font">Sort By :</span>
                        <a href="{{ URL::current() }}" class="sort-font pl-3">All</a><b class="pl-3">|</b>
                        <a href="{{ URL::current()."?sort=price_asc" }}" class="sort-font pl-3">Price - Low to High</a><b class="pl-3">|</b>
                        <a href="{{ URL::current()."?sort=price_desc" }}" class="sort-font pl-3">Price - High to Low</a><b class="pl-3">|</b>
                        <a href="{{ URL::current()."?sort=newest" }}" class="sort-font pl-3">Newest</a><b class="pl-3">|</b>
                        <a href="{{ URL::current()."?sort=popularity" }}" class="sort-font pl-3">Popularity</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <form action="{{ URL::current() }}" method="GET">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Brand
                                <button type="submit" class="btn btn-primary btn-sm float-right">Filter</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach ($subcategorylist as $itemcate)
                                @php
                                    $checked = [];
                                        if(isset($_GET['filterbrand']))
                                        {
                                            $checked = $_GET['filterbrand'];
                                        }
                                @endphp
                                <div class="mb-1">
                                    <input type="checkbox" name="filterbrand[]" value="{{ $itemcate->name }}"
                                        @if (in_array($itemcate->name, $checked)) checked  @endif
                                    />
                                        {{ $itemcate->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-body">
                        @if(count($products)!=0)
                            @foreach ($products as $product_item)
                                <div class="col-md-12 mb-3">
                                    <div class="card product_data">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="">
                                                        <img src="{{ asset($product_item->image)}}" class="w-100"  style="height: 170px" alt="">
                                                    </div>
                                                    <div class="wislist-content">
                                                        <input type="hidden" class="product_id" value="{{ $product_item->id }}">
                                                            @guest
                                                                <button type="button" data-toggle="modal" data-target="#userLogin_form" class="btn btn-danger btn-block shadow">
                                                                    <i class="fa fa-heart"></i>Add to Wishlist
                                                                </button>
                                                            @else
                                                                <button type="button" class="add-to-wishlist-btn btn btn-danger btn-block shadow">
                                                                    <i class="fa fa-heart"></i>Add to Wishlist
                                                                </button>
                                                            @endguest
                                                    </div>
                                                </div>
                                                <div class="col-md-7 border-right border-left">
                                                    <a href="{{ url('collection/'.$product_item->subcategory->category->group->url.'/'.$product_item->subcategory->category->url.'/'. $product_item->subcategory->url.'/'.$product_item->url) }}" class="text-center">
                                                        <h5 class="mb-2"><b>{{ $product_item->name }}</b></h5>
                                                    </a>
                                                    <div class="">
                                                        <h6 class="text-dark mb-0">{!! $product_item->p_highlights !!}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-right">
                                                        <h6 class="font-italic text-dark badge badge-warning px-3 py-2">{{$product_item->sale_tag}}</h6>
                                                        <h6 class="font-italic mt-2 py-2 font-weight-bold"><s> Rs: {{ number_format($product_item->original_price) }}</s></h6>
                                                        <h5 class="font-italic font-weight-bold mt-2"> Rs: {{number_format($product_item->offer_price) }}</h4>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="mt-2 py-2">
                                                            <a style="font-size: 16px" href="{{ url('collection/'.$product_item->subcategory->category->group->url.'/'.$product_item->subcategory->category->url.'/'. $product_item->subcategory->url.'/'.$product_item->url) }}" class="btn btn-outline-primary py-1 px-2">
                                                                View Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h2 class="text-center font-weight-bold">!!! No Product Available !!!</h2>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
