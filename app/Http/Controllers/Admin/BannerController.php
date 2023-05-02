<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $banners=Banner::where('is_delete','!=', '2')->paginate(10);
        return view('backend.admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:products',
            'description' => 'required',
            'photo' => 'required',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->status = $request->status;

        if($request->file('photo'))
        {
            $destinationPath = public_path('upload/banners/');
            $filename = $request->photo->getClientOriginalName();
            $request->photo->move($destinationPath, $filename);
            $banner->photo='upload/banners/'.$filename;
        }
        $banner->save();

        return redirect('banners');
    }

    public function edit($id)
    {
        $banner = Banner::findorFail($id);
        return view('backend.admin.banners.edit',compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $banner = Banner::findorFail($id);
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->status = $request->status;

        if($request->hasfile('photo'))
        {
            $dest = $banner->photo;
            if(File::exists($dest))
            {
                File::delete($dest);
            }
            $destinationPath = public_path('upload/banners/');
            $filename = $request->photo->getClientOriginalName();
            $request->photo->move($destinationPath, $filename);
            $banner->photo='upload/banners/'.$filename;
        }
        $banner->update();

        return redirect('banners');
    }

    public function state($id)
    {
        $banner = Banner::find($id);
        $banner->is_delete = '2';
        $banner->update();
        return redirect('banners');
    }

    public function deletedrecords()
    {
        $banners = Banner::where('is_delete', '2')->paginate(10);
        return view('backend.admin.banners.deleted',compact('banners'));
    }

    public function deletedrestore($id)
    {
        $banners = Banner::find($id);
        $banners->is_delete = '0';
        $banners->update();
        return redirect('banners');
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        $dest = $banner->photo;
        if(File::exists($dest))
        {
            File::delete($dest);
        }
        $banner->delete();
        return redirect('banners');
    }
}
