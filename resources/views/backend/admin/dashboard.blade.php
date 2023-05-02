@extends('backend.admin.layouts.common')

@section('title', 'dashboard')

@section('header')
    @parent
@endsection
@php
    $groups = App\Models\Group::where('vendor_id',Auth::user()->id)->count();
    $categories  = App\Models\Category::where('vendor_id',Auth::user()->id)->count();
    $subcategories  = App\Models\Subcategory::where('vendor_id',Auth::user()->id)->count();
    $products = App\Models\Product::where('vendor_id',Auth::user()->id)->count();
    $orders = App\Models\Order::count();
    $users = App\Models\User::count();
@endphp
@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="detail-box">
                                    <span class="count">{{$groups}}</span>
                                    <span class="count-tag">Groups</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="detail-box">
                                    <span class="count">{{$categories}}</span>
                                    <span class="count-tag">Categories</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="detail-box">
                                    <span class="count">{{$subcategories}}</span>
                                    <span class="count-tag">Sub Categories</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="detail-box">
                                    <span class="count">{{$products}}</span>
                                    <span class="count-tag">Products</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="detail-box">
                                    <span class="count">{{$orders}}</span>
                                    <span class="count-tag">Orders</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="detail-box">
                                    <span class="count">{{$users}}</span>
                                    <span class="count-tag">Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
