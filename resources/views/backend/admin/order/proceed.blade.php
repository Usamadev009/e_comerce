@extends('backend.admin.layouts.common')

@section('title', 'Orders')

@section('header')
    @parent
@endsection

@section('content')
    <div class="modal fade" id="CompleteORderModal" tabindex="-1" area-labelledby="exampleModalLabel" area-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id='#exampleModalLabel'>Complete Order</h5>
                    <button type="button" class="close" data-dismiss='modal' aria-label='close'>
                        <span area-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('order/complete-order/'.$orders->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        @if ($orders->payment_status == '0')
                            <h6>
                                <input type="checkbox" name="cash_received" required>Received Payment (Cash on Delivery)
                            </h6>
                            <p>Check the Box to Confirm that you received the Cash from Customer Close this order</p>
                        @else
                            <h5>The Payment has been done Online.</h5>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-0">Order Status</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('orders') }}" class="float-right py-1">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                            </div>
                            <div class="col-md-6">
                                <span class="float-right">
                                    <label class="bg-warning py-1 px-2 text-dark">Tracking Id: &nbsp; {{ $orders->tracking_no }}</label>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card shadow-sm border">
                                    <h6 class="card-header">Tracking Status</h6>
                                    <div class="card-body">
                                        <p>
                                            @if ($orders->tracking_msg == NULL)
                                                No Status Update.
                                            @else
                                                {{ $orders->tracking_msg }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border">
                                    <h6 class="card-header">Current Status</h6>
                                    <div class="card-body">
                                        <p>
                                            @if ($orders->order_status == '0')
                                                Order Pending
                                            @elseif ($orders->order_status == '1')
                                                Order Completed
                                            @elseif($orders->order_status == '2')
                                                Order Cancelled
                                                {{ $orders->cancel_reason }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border">
                                    <h6 class="card-header">Payment Status</h6>
                                    <div class="card-body">
                                        <p>
                                            @if ($orders->payment_status =='0')
                                                Status: {{ _('Payment Pending') }} <br>
                                                Mode: {{ $orders->payment_mode }}
                                            @elseif ($orders->payment_status =='1')
                                                Status: {{ _('Paid on Delivery') }} <br>
                                                Mode: {{ $orders->payment_mode }}
                                            @else
                                                {{ _('Paid Online') }}
                                            @endif

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tracking Status Updated --}}
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Tracking Status Update</h5>
                        <hr>
                        @if ($orders->order_status == '1')
                            {{ $orders->tracking_msg }}
                        @elseif ($orders->order_status == '2')
                            {{ $orders->tracking_msg }}
                        @else
                            <form action="{{ url('order/update-tracking-status/'.$orders->id) }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <select name="tracking_msg" class="custom-select" required id="inputGroupSelect02">
                                        <option value="">-- Select --</option>
                                        <option value="Pending" {{ $orders->tracking_msg == "Pending" ? 'selected':'' }}>Pending</option>
                                        <option value="Packed" {{ $orders->tracking_msg == "Packed" ? 'selected':'' }}>Packed</option>
                                        <option value="Shipped" {{ $orders->tracking_msg == "Shipped" ? 'selected':'' }}>Shipped</option>
                                        <option value="Delivered" {{ $orders->tracking_msg == "Delivered" ? 'selected':'' }}>Delivered</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-info text-white" for="inputGroupSelect02">Update</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            {{-- End - Tracking Status Updated --}}
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Cancel Order</h5>
                        <hr>
                        @if ($orders->order_status == '1')
                            Order Completed
                        @elseif($orders->order_status == '2')
                            {{ $orders->cancel_reason }}
                        @else
                            <form action="{{ url('order/cancel-order/'.$orders->id) }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <select name="cancel_reason" class="custom-select" required id="inputGroupSelect02">
                                        <option value="">-- Select --</option>
                                        <option value="Customer Not Available" {{ $orders->tracking_msg == "Pending" ? 'selected':'' }}>Customer Not Available</option>
                                        <option value="Product Damage" {{ $orders->tracking_msg == "Packed" ? 'selected':'' }}>Product Damage</option>
                                        <option value="No Response" {{ $orders->tracking_msg == "Shipped" ? 'selected':'' }}>No Response</option>
                                        <option value="Delayed" {{ $orders->tracking_msg == "Delivered" ? 'selected':'' }}>Delayed</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-info text-white" for="inputGroupSelect02">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <h5>Complete Order</h5>
                        <hr>
                        @if ($orders->order_status == '0')
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#CompleteORderModal" class="badge badge-pill badge-primary px-3 py-2">Proceed to Finish this Order</a>
                        @elseif($orders->order_status == '1')
                            Order Completed
                        @elseif($orders->order_status == '2')
                            Order Cancelled.! So not allowed to complete this order
                        @else
                            Nothing
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

