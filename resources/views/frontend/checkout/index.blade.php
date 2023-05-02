@extends('layouts.common')

@section('title', 'Cart')

@section('header')
    @parent
@endsection
@section('content')

<section class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="section-head mb-1">
                            Home / Checkout
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        @if (Cookie::get('shopping_cart') !=null)
            <div class="row">
                <div class="col-md-7">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <form action="{{ url('place-order') }}" method="POST" id="payment-form" class="require-validation" data-cc-on-file="false" novalidate>
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="First Name"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="lname" value="{{ Auth::user()->lname }}" class="form-control" placeholder="Last Name"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="mobile" value="{{ Auth::user()->mobile }}" class="form-control" placeholder="Phone"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" placeholder="Address"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control" placeholder="City"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" name="state" value="{{ Auth::user()->state }}" class="form-control" placeholder="State"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" name="pincode" value="{{ Auth::user()->pincode }}" class="form-control" placeholder="Pincode"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="place_order_btn" class="btn btn-primary btn-block">CASH ON DELIVERY</button>
                                        </div>
                                        {{-- 8880202617@ybl --}}
                                        <div class="col-md-6">
                                            <button type="button" class="razorpay_pay_btn btn btn-info btn-block">RAZORPAY PAY ONLINE</button>
                                        </div>
                                        {{-- 4242424242424242 --}}
                                        <div class="col-md-6 mt-2">
                                            @include('frontend.checkout.stripepaymodal')
                                            <button type="button" data-toggle="modal" data-target="#StripeCardModal" class="btn btn-danger btn-block">STRIPE - PAY ONLINE</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <div class="card mb-3">
                                <div class="card-body">
                                    Coupon Code
                                    <div class="input-group">
                                        <input type="text" name="coupon_code" class="form-control coupon_code" placeholder="Enter Coupon Code">
                                        <div class="input-group-append">
                                            <button class="btn btn-success apply_coupon_btn">Apply</button>
                                        </div>
                                    </div>
                                    <small id="error_coupon" class="text-danger"></small>
                                </div>
                            </div>
                            @if(isset($cart_data))
                                @if(Cookie::get('shopping_cart'))
                                    @php $total="0" @endphp
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1 ?>
                                            @foreach ($cart_data as $data)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{ $data['item_name'] }}</td>
                                                    <td>{{ number_format($data['item_price'], 0) }}</td>
                                                    <td>{{ $data['item_quantity'] }}</td>
                                                    @php $total = $total + ($data["item_quantity"] * $data["item_price"]) @endphp
                                                </tr>
                                                <?php $i++ ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3">
                                            <h6 class="mb-2">Sub Total</h6>
                                            <h6 class="mb-2">Discount</h6>
                                            <h5>Grand Total</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h6 class="mb-2"><b>-</b></h6>
                                            <h6 class="mb-2"><b>-</b></h6>
                                            <h5 class="mb-2"><b>-</b></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="mb-2">{{ number_format($total, 0) }}</h6>
                                            <h6 class="mb-2"><span class="discount_price">0,000</span></h6>
                                            <h5><span class="grandtotal_price">{{ number_format($total,0) }}</span></h5>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="row">
                                    <div class="col-md-12 mycard py-5 text-center">
                                        <div class="mycards">
                                            <h4>Your cart is currently empty.</h4>
                                                <a href="{{ url('collections') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue Shopping</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div><!-- /.container -->
</section>
@endsection

@section('script')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="{{ asset('js/checkout-stripe.js') }}"></script>
@endsection
