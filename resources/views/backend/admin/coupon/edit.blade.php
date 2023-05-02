@extends('backend.admin.layouts.common')

@section('title', 'Coupons')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container-fluid admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">
                            Coupon Code - Edit
                            <a href="{{ url('admin/coupon-view') }}" class="btn btn-sm btn-danger float-right">Back</a>
                        </h5>
                    </div>
                </div>
                <form action="{{ url('coupon-update/'.$coupon->id) }}" method="POST">
                    @csrf
                        <div class="modal-body card card-body mt-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label>Offer Name</label>
                                    <input type="text" value="{{$coupon->offer_name}}" name="offer_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Products (Optional)</label>
                                    <select name="product_id" class="form-control select2-products">
                                        <option value="0">Select</option>
                                        @foreach ($products as $proditem)
                                            <option value="{{ $proditem->id }}" {{ "$proditem->id" == "$coupon->product_id" ? 'selected':'' }}>
                                                {{ $proditem->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Coupon Code</label>
                                    <input type="text" value="{{$coupon->coupon_code}}" name="coupon_code" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Coupon Limit</label>
                                    <input type="text" value="{{$coupon->coupon_limit}}" name="coupon_limit" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Coupon Type</label>
                                    <select name="coupon_type" class="form-control">
                                        <option value="">Select Your Coupon Type</option>
                                        <option value="1" {{ "$coupon->coupon_type" == "1" ? 'selected':'' }}>Percentage</option>
                                        <option value="2" {{ "$coupon->coupon_type" == "2" ? 'selected':''}}>Amount</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Coupon Price</label>
                                    <input type="text" value="{{$coupon->coupon_price}}" name="coupon_price" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Start Date Time</label>
                                    <input type="datetime-local" value="{{ date('Y-m-d\TH:i', strtotime($coupon->start_datetime)) }}" name="start_datetime" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>End Date Time</label>
                                    <input type="datetime-local" value="{{ date('Y-m-d\TH:i', strtotime($coupon->end_datetime)) }}" name="end_datetime" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Status</label>
                                    <input type="checkbox" {{$coupon->status == "1" ? 'checked':''}} name="status" /> (0=Active ,  1= Block)
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Visibility Status</label>
                                    <input type="checkbox" {{$coupon->visibility_status == "1" ? 'checked':''}} name="visibility_status" /> (0=show, 1=hide)
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection
