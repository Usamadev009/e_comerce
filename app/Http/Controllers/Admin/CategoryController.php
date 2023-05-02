<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status','!=', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.admin.categorie.index',compact('categories'));
    }

    public function create()
    {
        $categorie = Category::all();
        return view('backend.admin.categorie.create',compact('categorie'));
    }

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
        return redirect('category')->with('status','Category Added Successfully');
    }

    public function edit($id)
    {
        $categorie = Category::findorFail($id);
        return view('backend.admin.categorie.edit',compact('categorie'));
    }

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

        return redirect('category')->with('status','Category Updated Successfully');
    }

    public function state($id)
    {
        $categorie = Category::find($id);
        $categorie->status = '2'; //0->show, 1->hide, 2->delete
        $categorie->update();
        return redirect('category');
    }

    public function deletedrecords()
    {
        $categories = Category::where('status', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.admin.categorie.deleted',compact('categories'));
    }

    public function deletedrestore($id)
    {
        $categories = Category::find($id);
        $categories->status = '0';
        $categories->update();
        return redirect('category');
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
        return redirect('category');
    }

}
