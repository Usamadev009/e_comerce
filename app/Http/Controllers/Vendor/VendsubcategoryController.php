<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Subcategory;

class VendsubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::where('status','!=', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.vendor.sub-category.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategory = new Subcategory;
        return view('backend.vendor.sub-category.create',compact('subcategory'));
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
            'category_id' => 'required',
            'name' => 'required|unique:subcategories',
            'url' => 'required',
            'description'  => 'required',
            'image'  => 'required',
            'priority'  => 'required',
        ]);

        $subcategory = new Subcategory();
        $subcategory->category_id=$request->category_id;
        $subcategory->name=$request->name;
        $subcategory->url = $request->url;
        $subcategory->description=$request->description;
        if($request->file('image'))
        {
            $destinationPath = public_path('/upload/subcategories');
            $filename = $request->image->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $subcategory->image= 'upload/subcategories/'.$filename;
        }
        $subcategory->priority = $request->priority;
        $subcategory->status = $request->input('status') == true ? '1':'0'; //0=show | 1=hide
        $subcategory->vendor_id = Auth::user()->id;
        $subcategory->save();

        return redirect('vendor-sub-categories')->with('status','Sub Category Saved Successfully.');
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
        $subcategory = Subcategory::findorFail($id);
        return view('backend.vendor.sub-category.edit',compact('subcategory'));
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
            'category_id' => 'required',
            'name' => 'required',
            'url' => 'required',
            'description'  => 'required',
            'priority'  => 'required',
        ]);

        $subcategory = Subcategory::findorFail($id);
        $subcategory->category_id=$request->category_id;
        $subcategory->name=$request->name;
        $subcategory->url = $request->url;
        $subcategory->description=$request->description;
        if($request->hasfile('image'))
        {
            $dest = $subcategory->image;
            if(File::exists($dest))
            {
                File::delete($dest);
            }
            $destinationPath = public_path('upload/subcategories/');
            $filename = $request->image->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $subcategory->image='upload/subcategories/'.$filename;
        }
        $subcategory->priority = $request->priority;
        $subcategory->status = $request->input('status') == true ? '1':'0'; //0=show | 1=hide
        $subcategory->vendor_id = Auth::user()->id;
        $subcategory->update();

        return redirect('vendor-sub-categories')->with('status','Subcategory Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function state($id)
    {
        $Subcategorie = Subcategory::find($id);
        $Subcategorie->status = '2';
        $Subcategorie->update();
        return redirect('vendor-sub-categories');
    }

    public function deletedrecords()
    {
        $subcategories = Subcategory::where('status', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.vendor.sub-category.deleted',compact('subcategories'));
    }

    public function deletedrestore($id)
    {
        $subcategories = Subcategory::find($id);
        $subcategories->status = '0';
        $subcategories->update();
        return redirect('vendor-sub-categories');
    }

    public function destroy($id)
    {
        $subcategorie = Subcategory::find($id);
        $dest = $subcategorie->image;
        if(File::exists($dest))
        {
            File::delete($dest);
        }
        $subcategorie->delete();
        return redirect('vendor-sub-categories');
    }
}
