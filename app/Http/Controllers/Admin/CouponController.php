<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status','0')->get();
        $coupon = Coupon::all();
        return view('backend.admin.coupon.index',compact('products','coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->offer_name = $request->offer_name;
        $coupon->product_id = $request->product_id;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_limit = $request->coupon_limit;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_price = $request->coupon_price;
        $coupon->start_datetime = $request->start_datetime;
        $coupon->end_datetime = $request->end_datetime;
        $coupon->status = $request->status == true ? '1':'0';
        $coupon->visibility_status = $request->visibility_status == true ? '1':'0';
        $coupon->save();

        return redirect()->back()->with('status','Coupon Code Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $products = Product::where('status','0')->get();
        return view('backend.admin.coupon.edit',compact('coupon','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->offer_name = $request->offer_name;
        $coupon->product_id = $request->product_id;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_limit = $request->coupon_limit;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_price = $request->coupon_price;
        $coupon->start_datetime = $request->start_datetime;
        $coupon->end_datetime = $request->end_datetime;
        $coupon->status = $request->status == true ? '1':'0';
        $coupon->visibility_status = $request->visibility_status == true ? '1':'0';
        $coupon->update();

        return redirect('admin/coupon-view')->with('status','Coupon Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
