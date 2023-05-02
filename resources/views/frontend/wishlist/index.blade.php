@extends('layouts.common')

@section('title', 'Wishlist')

@section('header')
    @parent
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="section-head mb-1">Home / Wishlist</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wishlist-header border p-2">
                        <div class="row">
                            <div class="col-md-7">
                                <h6 class="mb-o font-weight-bold">Product Detail</h6>
                            </div>
                            <div class="col-md-2">
                                <h6 class="mb-o font-weight-bold">Price</h6>
                            </div>
                            {{-- <div class="col-md-1">
                                <h6 class="mb-o font-weight-bold">View</h6>
                            </div> --}}
                            <div class="col-md-2">
                                <h6 class="mb-o font-weight-bold">Remove</h6>
                            </div>
                        </div>
                    </div>
                    @foreach ($wishlist as $item)
                        @if (isset($item->product))
                            <div class="wishlist-content mt-3">
                                <input type="hidden" class="wishlist_id" value="{{ $item->id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1 my-auto">
                                                <img src="{{ asset($item->product->image) }}" class="w-100" alt="">
                                            </div>
                                            <div class="col-md-6 my-auto">
                                                <h6>{{ $item->product->product_name }}</h6>
                                            </div>
                                            <div class="col-md-2 my-auto">
                                                <h6>{{ $item->product->offer_price }}</h6>
                                            </div>
                                            {{-- <div class="col-md-1 my-auto">
                                                <a href="" class="btn btn-primary btn-sm">View</a>
                                            </div> --}}
                                            <div class="col-md-2 my-auto">
                                                <button type="button" class="btn btn-danger btn-sm wishlist-remove-btn">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
