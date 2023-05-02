@extends('layouts.common')

@section('title', 'Category - SubCategory - Products - Product View')

@section('header')
    @parent
@endsection
@section('content')
<section>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="section-head mb-1">
                            Collection /
                            {{$products->subcategory->category->group->name}} /
                            {{$products->subcategory->category->name}} /
                            {{$products->subcategory->name}} /
                            {{$products->name}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="product_data">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="border">
                                        <img src="{{ asset($products->image)}}" class="w-100" alt="" style="height: 300px"/>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="product-heading py-2 border-top">
                                        <h5 class="mb-0 font-weight-bold">{{$products->name}}</h5>
                                    </div>
                                    <div class="py-2">
                                        <small class="font-weight-bold py-2">
                                            <b> Rating:
                                                @for ($i=1; $i<=5; $i++)
                                                    <i class="fa fa-star text-warning"></i>
                                                @endfor
                                            </b>
                                        </small>
                                        <small class="font-italic badge-primary ml-3 px-4 py-1">{{$products->sale_tag}}</small>
                                    </div>
                                    <div class="product-price">
                                        <h5>
                                            <span class="offer-price font-weight-bold">Rs: {{ number_format($products->offer_price) }} </span>
                                            <span class="selling-price ml-5"><s>Rs: {{ number_format($products->original_price) }} </s></span>
                                        </h5>
                                    </div>
                                    <div class="py-3">
                                        <div class="row product_data">
                                            <div class="col-md-2 col-3">
                                                <input type="hidden" class="product_id" value="{{$products->id}}" />
                                                <input type="number" class="qty-input form-control" value="1" min="1" max="100"/>
                                            </div>
                                            <div class="col-md-3 col-6 product">
                                                <button type="button" class="add-to-cart-btn btn btn-danger m-0 py-2 px-3">Add to Cart</button>
                                            </div>
                                            <div class="col-md-3">
                                                @guest
                                                    <input type="hidden" class="product_id" value="{{ $products->id }}">
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
                                    </div>
                                    <div class="product-small-description py-2 border-top">
                                        {!! $products->small_description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab">Description</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab">Review</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content border p-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="product-highlights py-2 border-top">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h6 class="highlight-heading mb-0 font-weight-bold">{{ $products->p_highlight_heading }}</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                {!! $products->p_highlights !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-description py-2 border-top">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h6 class="prod-desc-heading mb-0 font-weight-bold">{{ $products->p_description_heading }}</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                {!! $products->p_description !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-details py-2 border-top">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h6 class="prod-detail-heading mb-0 font-weight-bold">{{ $products->p_details_heading }}</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                {!! $products->p_details !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="review" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="comment-review">
                                                                <div class="add-review">
                                                                    <h3 style="font-weight: bold">Add A Review</h3>
                                                                    <p>Your email address will not be published. Required fields are marked</p>
                                                                </div>
                                                                <h4 style="font-weight: bold">Your Rating <span class="text-danger">*</span></h4>
                                                                <div class="review-inner">
                                                                    @auth
                                                                        <form class="form" method="POST" action="{{ route('review.store',[$products->id])}}">
                                                                            @csrf
                                                                                <input type="hidden" class="product_id" value="{{ $products->id }}">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-12">
                                                                                        <div class="rating_box">
                                                                                            <div class="star-rating">
                                                                                                <div class="star-rating__wrap">
                                                                                                    <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                                                                                    <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars" ></label>
                                                                                                    <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                                                                                    <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                                                                                                    <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                                                                                    <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                                                                                                    <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                                                                                    <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                                                                                                    <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
                                                                                                    <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
                                                                                                    @error('rate')
                                                                                                        <span class="text-danger">{{$message}}</span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Write a review</label>
                                                                                            <textarea name="review" rows="6" class="w-100" placeholder="" ></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group button5">
                                                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </form>
                                                                    @else
                                                                        <p class="mt-2">
                                                                            You need to <a class="btn btn-primary" style="width: 100px;height: 30px" data-toggle="modal" data-target="#userLogin_form" href="{{ route('login') }}">Login</a>
                                                                        </p>
                                                                    @endauth
                                                                </div>
                                                            </div>
                                                            <div class="ratting-main">
                                                                <div class="avg-ratting">
                                                                    <h4><span>(Overall)</span></h4>
                                                                    <span>Based on Comments</span>
                                                                </div>
                            									<!-- Single Rating -->
							    								<div class="single-rating">
																	<div class="rating-author">
																	</div>
																	<div class="rating-des">
																		<h6></h6>
																		<div class="ratings">
																			<ul class="rating">
																				{{-- @for($i=1; $i<=5; $i++) --}}
																					{{-- @if($data->rate>=$i) --}}
																						<li><i class="fa fa-star"></i></li>
																					{{-- @else --}}
																						<li><i class="fa fa-star-o"></i></li>
																					{{-- @endif --}}
																				{{-- @endfor --}}
																			</ul>
																			<div class="rate-count">(<span></span>)</div>
																		</div>
																			<p></p>
																	</div>
																</div>
																<!--/ End Single Rating -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-weight-bold">Related Products</h4>
                <hr>

                <div class="owl-carousel owl-theme">
                    @foreach ($products->subcategory->product as $item)
                        <div class="item">
                            <div class="card border">
                                <div class="card-body">
                                    <img src="{{ asset($item->image) }}" alt="Product Image" class="w-100" style="height: 250px"/>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>{{ $item->name }}</h6>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Rs: {{ number_format($item->offer_price) }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6><s>Rs: {{ number_format($item->original_price) }}</s></h6>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="" class="btn btn-block btn-primary">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
@endsection
