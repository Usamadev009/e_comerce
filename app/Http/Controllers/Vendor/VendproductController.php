<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VendproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status','!=', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.vendor.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products',
            'sub_category_id'  => 'required',
            'url' => 'required',
            'small_description' => 'required',
            'image' => 'required',
            'original_price' => 'required',
            'offer_price' => 'required',
            'quantity' => 'required',
            'priority' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->sub_category_id = $request->sub_category_id;
        $product->url = $request->url;
        $product->small_description = $request->small_description;
        if($request->file('image'))
        {
            $destinationPath = public_path('/upload/products');
            $filename = $request->image->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $product->image= 'upload/products/'.$filename;
        }
        $product->original_price = $request->original_price;
        $product->offer_price = $request->offer_price;
        $product->quantity = $request->quantity;
        $product->priority = $request->priority;
        $product->p_highlight_heading = $request->p_highlight_heading;
        $product->p_highlights = $request->p_highlights;
        $product->p_description_heading = $request->p_description_heading;
        $product->p_description = $request->p_description;
        $product->p_details_heading = $request->p_details_heading;
        $product->p_details = $request->p_details;
        $product->new_product = $request->input('new_product') == true ? '1':'0';
        $product->featured_products = $request->input('featured_products') == true ? '1':'0';
        $product->popular_products = $request->input('popular_products') == true ? '1':'0';
        $product->offer_products = $request->input('offer_products') == true ? '1':'0';
        $product->status = $request->input('status') == true ? '1':'0';
        $product->vendor_id = Auth::user()->id;
        $product->save();

        return redirect('vendor-products')->with('status','Product Added Successfully.');
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
        $product = Product::findorFail($id);
        return view('backend.vendor.product.edit',compact('product'));
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
        $validated = $request->validate([
            'name' => 'required',
            'sub_category_id'  => 'required',
            'url' => 'required',
            'small_description' => 'required',
            'original_price' => 'required',
            'offer_price' => 'required',
            'quantity' => 'required',
            'priority' => 'required',
        ]);
        $product = Product::findorFail($id);
        $product->name = $request->name;
        $product->sub_category_id = $request->sub_category_id;
        $product->url = $request->url;
        $product->small_description = $request->small_description;
        if($request->hasfile('image'))
        {
            $dest = $product->image;
            if(File::exists($dest))
            {
                File::delete($dest);
            }
            $destinationPath = public_path('upload/products/');
            $filename = $request->image->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $product->image='upload/products/'.$filename;
        }
        $product->original_price = $request->original_price;
        $product->offer_price = $request->offer_price;
        $product->quantity = $request->quantity;
        $product->priority = $request->priority;
        $product->p_highlight_heading = $request->p_highlight_heading;
        $product->p_highlights = $request->p_highlights;
        $product->p_description_heading = $request->p_description_heading;
        $product->p_description = $request->p_description;
        $product->p_details_heading = $request->p_details_heading;
        $product->p_details = $request->p_details;
        $product->new_product = $request->input('new_product') == true ? '1':'0';
        $product->featured_products = $request->input('featured_products') == true ? '1':'0';
        $product->popular_products = $request->input('popular_products') == true ? '1':'0';
        $product->offer_products = $request->input('offer_products') == true ? '1':'0';
        $product->status = $request->input('status') == true ? '1':'0';
        $product->vendor_id = Auth::user()->id;
        $product->update();

        return redirect('vendor-products')->with('status','Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function state($id)
    {
        $product = Product::find($id);
        $product->status = '2';
        $product->update();
        return redirect('vendor-products');
    }

    public function deletedrecords()
    {
        $products = Product::where('status', '2')->paginate(10);
        return view('backend.vendor.product.deleted',compact('products'));
    }

    public function deletedrestore($id)
    {
        $brands = Product::find($id);
        $brands->status = '0';
        $brands->update();
        return redirect('vendor-products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $dest = $product->image;
        if(File::exists($dest))
        {
            File::delete($dest);
        }
        $product->delete();
        return redirect('vendor-products');
    }
}
