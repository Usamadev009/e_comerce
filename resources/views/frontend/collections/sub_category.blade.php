@extends('layouts.common')

@section('title', 'Category - SubCategory')

@section('header')
    @parent
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="section-head mb-1">Collection / {{$category->group->name}} / {{$category->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="row">
                    @if(count($subcategory)!=0)
                        @foreach ($subcategory as $subcat_item)
                            <div class="col-md-3 mb-4">
                                <a href="{{ url('collection/'.$subcat_item->category->group->url.'/'.$subcat_item->category->url.'/'. $subcat_item->url) }}" class="text-center">
                                    <div class="card">
                                        <img src="{{ asset($subcat_item->image)}}" class="w-100" height="300px" width="270px" alt="">
                                        <div class="card-body bg-light">
                                            <h6 class="mb-0"><b>{{ $subcat_item->name }}</b></h6>
                                        </div>
                                    </div>
                                </a>
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
@endsection
