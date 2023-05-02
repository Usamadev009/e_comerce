<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\File;


class FrontendController extends Controller
{
    public function myprofile()
    {
        return view('frontend.user.profile');
    }

    public function editprofile()
    {
        return view('frontend.user.edit');
    }

    public function profileupdate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'mobile' => 'required',
        ]);

            $user = User::findorFail(Auth::user()->id);
            $user->name = $request->name;
            $user->lname = $request->lname;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->pincode = $request->pincode;
            $user->mobile = $request->mobile;

            if($request->hasfile('image'))
            {
                $destination = 'upload/profile/'.$user->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('upload/profile/',$filename);
                $user->image = $filename;
            }
            $user->update();
            return redirect('my-profile');
    }

    public function index()
    {
        $banners = Banner::where('status','Publish')->where('is_delete','0')->orderBy('id','DESC')->get();
        $newproducts = Product::where('status','0')->where('new_product','1')->orderBy('created_at','desc')->get();
        $popularproducts = Product::where('status','0')->where('popular_products','1')->orderBy('created_at','desc')->get();
        $featuredproducts = Product::where('status','0')->where('featured_products','1')->orderBy('created_at','desc')->get();
        $offerproducts = Product::where('status','0')->where('offer_products','1')->orderBy('created_at','desc')->get();
        return view ('frontend.index', compact('banners','newproducts','popularproducts','featuredproducts','offerproducts'));
    }

    public function newarrivals()
    {
        $newproducts = Product::where('status','0')->where('new_product','1')->orderBy('created_at','desc')->get();
        return view ('frontend.newarrivals.index', compact('newproducts'));
    }

    public function popular()
    {
        $popularproducts = Product::where('status','0')->where('popular_products','1')->orderBy('created_at','desc')->get();
        return view('frontend.popular-products.index', compact('popularproducts'));
    }

    public function featured()
    {
        $featuredproducts = Product::where('status','0')->where('featured_products','1')->orderBy('created_at','desc')->get();
        return view('frontend.featured-products.index', compact('featuredproducts'));
    }

    public function offer()
    {
        $offerproducts = Product::where('status','0')->where('offer_products','1')->orderBy('created_at','desc')->get();
        return view('frontend.offer-products.index', compact('offerproducts'));
    }

    public function allproducts()
    {
        $allproducts = Product::where('status','0')->orderBy('created_at','desc')->get();
        return view('frontend.all-products.index', compact('allproducts'));
    }

    public function review(Request $request)
    {
        dd($request->all());
    }

    public function register()
    {
        return view('frontend.register');
    }
}
