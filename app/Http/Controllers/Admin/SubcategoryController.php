<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::where('status','!=', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.admin.sub_category.index',compact('subcategories'));
    }

    public function create()
    {
        $subcategory = new Subcategory;
        return view('backend.admin.sub_category.create',compact('subcategory'));
    }

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

        return redirect('subcategory')->with('status','Sub Category Saved Successfully.');
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findorFail($id);
        return view('backend.admin.sub_category.edit',compact('subcategory'));
    }

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

        return redirect('subcategory')->with('status','Subcategory Updated Successfully.');
    }

    public function state($id)
    {
        $Subcategorie = Subcategory::find($id);
        $Subcategorie->status = '2';
        $Subcategorie->update();
        return redirect('subcategory');
    }

    public function deletedrecords()
    {
        $subcategories = Subcategory::where('status', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.admin.sub_category.deleted',compact('subcategories'));
    }

    public function deletedrestore($id)
    {
        $subcategories = Subcategory::find($id);
        $subcategories->status = '0';
        $subcategories->update();
        return redirect('subcategory');
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
        return redirect('subcategory');
    }
}
