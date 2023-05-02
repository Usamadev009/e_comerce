@extends('backend.admin.layouts.common')

@section('title', 'Orders')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">
                            Order View
                            <a href="{{ url('generate-invoice/'.$orders->id) }}" class="btn btn-success float-right">Generate Invoice</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="m-2" style="border: groove;">
                        <h5 class="m-2">Order Details</h5>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <div class="border p-2 m-2">
                                    <label>Tracking No</label>
                                    <h6>{{ $orders->tracking_no }}</h6>
                                </div>
                            </div>
                            <div class="col-md-8 mt-3">
                                <div class="border p-2 m-2">
                                    <label>Tracking Msg</label>
                                    <h6>{{ isset($orders->tracking_msg) == true ? $orders->tracking_msg:'Nothing Updated' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="border p-2 m-2">
                                    <label>Payment Mode</label>
                                    <h6>{{ $orders->payment_mode }}</h6>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                    {{-- Payment Status =
                                    0 = Pending Nothing Paid
                                    1 = Cash Paid
                                    2 = Razorpay payment successful
                                    3 = Razorpay payment failed
                                    4 = pay, stripe
                                    5 = Stripe Failed --}}
                                <div class="border p-2 m-2">
                                    <label>Payment Status</label>
                                    <h6>
                                        @if ($orders->payment_status == '0')
                                            Pending
                                        @elseif ($orders->payment_status == '1')
                                            COD - Paid
                                        @elseif ($orders->payment_status == '2')
                                            Razorpay Successful
                                        @elseif ($orders->payment_status == '3')
                                            Razorpay Failed
                                        @elseif ($orders->payment_status == '4')
                                            Stripe Successful
                                        @elseif ($orders->payment_status == '5')
                                            Stripe Failed
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="border p-2 m-2">
                                    <label>Payment ID</label>
                                    <h6>{{ isset($orders->payment_id) == true ? $orders->payment_id:'COD Payment No id' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                {{-- 0 = Pending
                                1 = Completed
                                2 = Rejected/Cancelled --}}
                                <div class="border p-2 m-2">
                                    <label>Order Status</label>
                                    <h6>
                                        @if ($orders->order_status == '0')
                                            Pending
                                        @elseif ($orders->order_status == '1')
                                            Completed
                                        @elseif ($orders->order_status == '2')
                                            Cancell
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="border p-2 m-2">
                                    <label>Cancelled Reason</label>
                                    <h6>{{ isset($orders->cancel_reason) == true ? $orders->cancel_reason:'Not Cancelled' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-dark">
                    <div class="m-2" style="border: groove;">
                        <h5 class="m-2">Order Item</h5>
                        <div class="row m-1">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Grandtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @php $total = '0'; @endphp
                                        @foreach ($orders->orderitems as $order)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $order->product?$order->product->name: '' }}</td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>{{ number_format($order->price, 0) }}</td>
                                                <td>{{ number_format($order->price * $order->quantity, 0) }}</td>
                                            </tr>
                                        @php $total = $total + ($order->price * $order->quantity)  @endphp
                                        @php $i++ @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-right">
                                                <b>Sub Total</b>
                                            </td>
                                            <td><b>{{ number_format($total, 0) }}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-right">
                                                <b>Tax Amount</b>
                                            </td>
                                            <td>
                                                {{-- Grand_Total = total_amount * Tax /100 --}}
                                                @if (isset($order->tax_amt))
                                                    @php
                                                        $tax = $order->tax_amt;
                                                        $tax_total = ($total + $tax)/100;
                                                    @endphp
                                                    <b>{{ number_format($tax_total) }}</b>
                                                @else
                                                    <b>0</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-right">
                                                <b>Grand Total</b>
                                            </td>
                                            <td>
                                                @if (isset($order->tax_amt))
                                                    @php    $grandtotal = $tax_total + $total    @endphp
                                                    <b>{{ number_format($grandtotal, 0) }}</b>
                                                @else
                                                    <b>{{ number_format($total, 0) }}</b>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-dark">
                    <div class="card mt-3 mb-3">
                        <div class="m-2" style="border: groove">
                            <h5 class="m-2">Customer Details</h5>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div class="border p-2 m-2">
                                        <label>First Name</label>
                                        <h6>{{ $orders->users->name }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="border p-2 m-2">
                                        <label>Last Name</label>
                                        <h6>{{ $orders->users->lname }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="border p-2 m-2">
                                        <label>Email</label>
                                        <h6>{{ $orders->users->email }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="border p-2 m-2">
                                        <label>Address</label>
                                        <h6>{{ $orders->users->address }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="border p-2 m-2">
                                        <label>City</label>
                                        <h6>{{ $orders->users->city }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="border p-2 m-2">
                                        <label>State</label>
                                        <h6>{{ $orders->users->state }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="border p-2 m-2">
                                        <label>Pincode</label>
                                        <h6>{{ $orders->users->pincode }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

