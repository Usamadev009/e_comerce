<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlaceorderMailable;
use Illuminate\Support\Facades\Cookie;
use App\Models\Coupon;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        return view('frontend.checkout.index',compact('cart_data'));
    }

    public function checkingcoupon(Request $request)
    {
        $couponcode = $request->coupon_code;

        if(Coupon::where('coupon_code',$couponcode)->exists())
        {
            $coupon = Coupon::where('coupon_code',$couponcode)->first();
            if($coupon->start_datetime <- Carbon::today()->format('Y-m-d') && Carbon::today()->format('Y-m-d') <-$coupon->end_datetime)
            {
                $totalprice = "0";
                $cookie_data = stripslashes($request->cookie('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
                foreach($cart_data as $itemdata)
                {
                    $products = Product::find($itemdata['item_id']);
                    $prod_price = $products->offer_price;
                    // $prod_price_with_tax = ($prod_price * $products->tax_amt)/100; //Tax, Vat, GST

                    $totalprice = $totalprice + ($itemdata["item_quantity"] * $prod_price);
                }
                // Coupon Type (Checking Percentage OR Amount)
                if($coupon->coupon_type == "1") //1=Percentage
                {
                    $discount_price = ($totalprice / 100) * $coupon->coupon_price;
                }
                elseif($coupon->coupon_type == "2")
                {
                    $discount_price = $coupon->coupon_price;
                }
                $grand_total = $totalprice - $discount_price;

                return response()->json([
                    'discount_price' => $discount_price,
                    'grand_total_price' => $grand_total,
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>'Coupon Code has been Expired.',
                    'error_status'=>'error',
                ]);
            }
        }
        else
        {
            return response()->json([
                'status'=>'Coupon Code does not exists.',
                'error_status'=>'error',
            ]);
        }
    }

    private function update_user($user_id, $request)
    {
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->lname = $request->lname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->pincode = $request->pincode;
        return $user->save();
    }

    private function insert_orderitem($last_order_id)
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        $items_in_cart = $cart_data;

        foreach((array) $items_in_cart as $itemdata)
        {
            $products = Product::find($itemdata['item_id']);
            $pric_value = $products->offer_price;
            $tax_amt = $products->tax_amt;
            Order_item::create([
                'order_id' => $last_order_id,
                'product_id' => $itemdata['item_id'],
                'price' => $pric_value,
                'tax_amt' => $tax_amt,
                'quantity' => $itemdata['item_quantity'],
            ]);
        }
    }

    private function placeorderMailable($request)
    {
        $order_data = [
            'name' => $request->input('name'),
            'lname' => $request->input('lname'),
            'mobile' => $request->input('mobile'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
            'email' => $request->input('email'),
        ];

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $items_in_cart = json_decode($cookie_data, true);

        $to_customer_email = $request->input('email');//Auth::user()->email;
        Mail::to($to_customer_email)->send(new PlaceorderMailable($order_data, $items_in_cart));
    }

    public function storeorder(Request $request)
    {
        /*
            Payment Status =
            0 = Nothing Paid
            1 = Cash Paid
            2 = Razorpay payment successful
            3 = Razorpay payment failed
            4 = pay, stripe
        */
        if(isset($_POST['place_order_btn']))
        {
            // User Data Update
            $user_id = Auth::user()->id;
            $this->update_user($user_id, $request);

            // Placing Order
            $trackno = rand(1111,9999);
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->tracking_no = 'project'. $trackno;
            $order->payment_mode = "Cash on Delivery";
            $order->payment_status = '0';
            $order->order_status = '0';
            $order->notify = '0';
            $order->save();

            $last_order_id = $order->id;

            // Ordered -  Cart items
            $this->insert_orderitem($last_order_id);

            // Send Mail
            $this->placeorderMailable($request);

            Cookie::queue(Cookie::forget('shopping_cart'));
            return redirect('/thank-you')->with('status','Order has been placed Successfully');
        }

        if(isset($_POST['place_order_razorpay']))
        {
            // User Data Update
            $user_id = Auth::user()->id;
            $this->update_user($user_id, $request);

            // Placing Order
            $trackno = rand(1111,9999);

            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->tracking_no = 'project'. $trackno;
            $order->payment_mode = "Payment by Razorpay";
            $order->payment_id = $request->input('razorpay_payment_id');
            $order->payment_status = '2';
            $order->order_status = '0';
            $order->notify = '0';
            $order->save();

            $last_order_id = $order->id;

            // Ordered -  Cart items
            $this->insert_orderitem($last_order_id);

            Cookie::queue(Cookie::forget('shopping_cart'));
        }

        if(isset($_POST['stipe_payment_btn']))
        {
            // User Data Update
            $user_id = Auth::user()->id;
            $this->update_user($user_id, $request);

            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_in_cart = $cart_data;

            $total = '0';
            foreach($items_in_cart as $itemdata)
            {
                $products = Product::find($itemdata['item_id']);
                $pric_value = $products->offer_price;
                $total = $total + ($itemdata['item_quantity'] * $pric_value);
            }

            $stripetoken = $request->input('stripeToken');
            $STRIPE_SECRET = "sk_test_51JhY94JLQ6qvm6HDBZcrjrvQiG65N9BsMK696vELnLqQVgMXhbC5IgIpAoTjioCJeK7xNTmoTz9sj22qURNWO9KI00Z3Bs3IwR";
            Stripe::setApiKey($STRIPE_SECRET);
            \Stripe\Charge::create([
                'amount' => 1 * 100,    //$total * 100 replace
                'currency' => 'usd',
                'description' => "Thank you for purchasing with Fabcart",
                'source' => $stripetoken,
                'shipping' => [
                    'name' => Auth::user()->name,
                    'phone' => Auth::user()->mobile,
                    'address' => [
                        'line1' => Auth::user()->address,
                        'line2' => "Address 2",
                        'postal_code' => Auth::user()->pincode,
                        'city' => "Lahore",
                        'state' => "Punjab",
                        'country' => 'Pakistan',
                    ],
                ],
            ]);

            // Placing Order
            $trackno = rand(1111,9999);

            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->tracking_no = 'project'. $trackno;
            $order->payment_mode = "Payment by Stripe";
            $order->payment_id = $stripetoken;
            $order->payment_status = '3';
            $order->order_status = '0';
            $order->notify = '0';
            $order->save();

            $last_order_id = $order->id;

            // Ordered -  Cart items
            $this->insert_orderitem($last_order_id);

            Cookie::queue(Cookie::forget('shopping_cart'));
            return redirect('/thank-you')->with('status','Order has been placed Successfully');

        }
    }

    public function checkamount(Request $request)
    {
        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_in_cart = $cart_data;

            $total = '0';
            foreach($items_in_cart as $itemdata)
            {
                $products = Product::find($itemdata['item_id']);
                $pric_value = $products->offer_price;
                $total = $total + ($itemdata['item_quantity'] * $pric_value);
            }

            return response()->json([
                'name' => $request->name,
                'lname' => $request->lname,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'email' => Auth::user()->email,
                'total_price' => $total,
            ]);
        }
        else
        {
            return response()->json([
                'status_code' => 'no_data_in_cart',
                'status' => 'Your cart is empty',
            ]);
        }
    }
}
