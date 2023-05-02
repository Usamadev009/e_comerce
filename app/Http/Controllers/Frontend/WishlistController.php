<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist.index',compact('wishlist'));
    }

    public function storewishlist(Request $request)
    {
        $product_id = $request->product_id;
        if( Wishlist::where('user_id',Auth::id())->where('product_id', $product_id)->exists() )
        {
            return response()->json(['status'=>'Product is already Added to Wishlist']);
        }
        else
        {
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::id();
            $wishlist->product_id = $product_id;
            $wishlist->save();
            return response()->json(['status'=>'Product is added to Wishlist']);
        }
    }

    public function removewishlistitem(Request $request)
    {
        $wishlist_id = $request->wishlist_id;
        if( Wishlist::where('user_id',Auth::id())->where('id',$wishlist_id)->exists() )
        {
            $wishlist = Wishlist::where('user_id',Auth::id())->where('id',$wishlist_id)->first();
            $wishlist->delete();
            return response()->json(['status'=>'Item Removed from Wishlist']);
        }
        else
        {
            return response()->json(['status'=>'No Items Found in Wishlist']);
        }
    }
}
