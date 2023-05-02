@extends('backend.admin.layouts.common')

@section('title', 'Coupons')

@section('header')
    @parent
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('coupon-store') }}" method="POST">
                @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Offer Name</label>
                                <input type="text" name="offer_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Products (Optional)</label>
                                <select name="product_id" class="form-control select2-products">
                                    <option value="">Select</option>
                                    @foreach ($products as $proditem)
                                        <option value="{{ $proditem->id }}">{{ $proditem->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Coupon Code</label>
                                <input type="text" name="coupon_code" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Coupon Limit</label>
                                <input type="text" name="coupon_limit" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Coupon Type</label>
                                <select name="coupon_type" class="form-control">
                                    <option value="">Select Your Coupon Type</option>
                                    <option value="1">Percentage</option>
                                    <option value="2">Amount</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Coupon Price</label>
                                <input type="text" name="coupon_price" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Start Date Time</label>
                                <input type="datetime-local" name="start_datetime" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>End Date Time</label>
                                <input type="datetime-local" name="end_datetime" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Status</label>
                                <input type="checkbox" name="status" /> (0=Active ,  1= Block)
                            </div>                          <div class="col-md-6 mb-2">
                                <label>Visibility Status</label>
                                <input type="checkbox" name="visibility_status" /> (0=show, 1=hide)
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container-fluid admin-content-container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">
                            Coupon Code
                            <a href="#" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#couponModal">Add Coupon</a>
                        </h5>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Offer</th>
                                    <th>Coupon Code</th>
                                    <th>Expiry DateTime</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($coupon as $couponitem)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $couponitem->offer_name }}</td>
                                        <td>{{ $couponitem->coupon_code }}</td>
                                        <td>{{ $couponitem->end_datetime }}</td>
                                        <td>
                                            @if($couponitem->status =="1")
                                                <label class="badge badge-pill badge-danger">Disabled</label>
                                            @else
                                                <label class="badge badge-pill badge-success">Active</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ 'coupon-edit/'.$couponitem->id }}" class="btn btn-sm btn-success">Edit</a>
                                        </td>
                                    </tr>
                                @php $i++ @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

