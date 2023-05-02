@extends('layouts.common')

@section('title', 'Popular Products')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Popular Products</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="row">
                        @if(count($popularproducts)!=0)
                            @foreach ($popularproducts as $pop_item)
                                <div class="col-md-3 mt-3">
                                    <div class="card">
                                        <img src="{{ asset($pop_item->image) }}" class="w-100" alt="New Products" style='height: 250px' />
                                        <div class="card-body text-center">
                                            <h5 class="font-weight-bold text-truncate">{{ $pop_item->name }}</h5>
                                            <h6>
                                                <span class="font-italic mr-2"> <s>Rs: {{ $pop_item->original_price }} </s> </span>
                                                <span class="font-weight-bold"> Rs: {{ $pop_item->original_price }} </span>
                                            </h6>
                                            <a href="{{ url('collection/'.$pop_item->subcategory->category->group->url.'/'.$pop_item->subcategory->category->url.'/'. $pop_item->subcategory->url.'/'.$pop_item->url) }}" class="btn btn-outline-primary mt-2">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h2 class="text-center font-weight-bold">!!! No Popular Product Available !!!</h2>
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
