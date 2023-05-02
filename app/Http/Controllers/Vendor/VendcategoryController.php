<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VendcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status','!=', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.vendor.categorie.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = Category::all();
        return view('backend.vendor.categorie.create',compact('categorie'));
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
            'group_id' => 'required',
            'name' => 'required|unique:categories',
            'url' => 'required',
            'description' => 'required',
            'image' => 'required',
            'icon' => 'required',
        ]);


        $category = new Category();
        $category->group_id=$request->group_id;
        $category->name=$request->name;
        $category->url=$request->url;
        $category->description=$request->description;
        if($request->file('image'))
        {
            $destinationPath = public_path('/upload/categories/images');
            $filename = $request->image->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $category->image= 'upload/categories/images/'.$filename;
        }
        if($request->file('icon'))
        {
            $destinationPath = public_path('/upload/categories/icons');
            $filename = $request->icon->getClientOriginalName();
            $request->icon->move($destinationPath, $filename);
            $category->icon= 'upload/categories/icons/'.$filename;
        }
        $category->status = $request->input('status') == true ? '1':'0'; //0=show | 1=hide
        $category->vendor_id = Auth::user()->id;
        $category->save();
        return redirect('vendor-categories')->with('status','Category Added Successfully');
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
        $categorie = Category::findorFail($id);
        return view('backend.vendor.categorie.edit',compact('categorie'));
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
            'group_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = Category::findorFail($id);
        $category->group_id=$request->group_id;
        $category->name=$request->name;
        $category->url=$request->url;
        $category->description=$request->description;
        if($request->file('image'))
        {
            $destinationPath = public_path('/upload/categories/images');
            $filename = $request->image->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $category->image= 'upload/categories/images/'.$filename;
        }
        if($request->file('icon'))
        {
            $destinationPath = public_path('/upload/categories/icons');
            $filename = $request->icon->getClientOriginalName();
            $request->icon->move($destinationPath, $filename);
            $category->icon= 'upload/categories/icons/'.$filename;
        }
        $category->status = $request->input('status') == true ? '1':'0'; //0=show | 1=hide
        $category->vendor_id = Auth::user()->id;
        $category->update();

        return redirect('vendor-categories')->with('status','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function state($id)
    {
        $categorie = Category::find($id);
        $categorie->status = '2'; //0->show, 1->hide, 2->delete
        $categorie->update();
        return redirect('vendor-categories');
    }

    public function deletedrecords()
    {
        $categories = Category::where('status', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.vendor.categorie.deleted',compact('categories'));
    }

    public function deletedrestore($id)
    {
        $categories = Category::find($id);
        $categories->status = '0';
        $categories->update();
        return redirect('vendor-categories');
    }

    public function destroy($id)
    {
        $categorie = Category::find($id);
        $dest = $categorie->image;
        if(File::exists($dest))
        {
            File::delete($dest);
        }
        $categorie->delete();
        return redirect('vendor-categories');
    }
}
