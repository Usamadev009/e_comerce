@extends('layouts.common')

@section('title', 'Featured Products')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Featured Products</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="row">
                        @if(count($featuredproducts)!=0)
                            @foreach ($featuredproducts as $fet_item)
                                <div class="col-md-3 mt-3">
                                    <div class="card">
                                        <img src="{{ asset($fet_item->image) }}" class="w-100" alt="New Products" style='height: 250px' />
                                        <div class="card-body text-center">
                                            <h5 class="font-weight-bold text-truncate">{{ $fet_item->name }}</h5>
                                            <h6>
                                                <span class="font-italic mr-2"> <s>Rs: {{ $fet_item->original_price }} </s> </span>
                                                <span class="font-weight-bold"> Rs: {{ $fet_item->original_price }} </span>
                                            </h6>
                                            <a href="{{ url('collection/'.$fet_item->subcategory->category->group->url.'/'.$fet_item->subcategory->category->url.'/'. $fet_item->subcategory->url.'/'.$fet_item->url) }}" class="btn btn-outline-primary mt-2">
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
