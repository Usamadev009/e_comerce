<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_delet','!=', '2')->get();
       return view('backend.admin.user.index', compact('users'));
    }

    public function create()
    {
        $user = new User;
        return view('backend.admin.user.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique',
            'email' => 'required|unique',
            'password' => 'required',
            'mobile' => 'required|unique',
            'address' => 'required',
            'image' => 'required',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->status = $request->status;
        if($request->file('image'))
        {
            $destinationPath = public_path('/upload/profiles');
            $filename = $request->image->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $user->image= 'upload/profiles/'.$filename;
        }
        $user->save();

        return redirect('users');
    }

    public function show($id)
    {
        $user = User::findorFail($id);
        return view('backend.admin.user.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::findorFail($id);
        return view('backend.admin.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

            $user = User::findorFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->role = $request->role;
            $user->status = $request->status;
            if($request->hasfile('image'))
                {
                    $dest = $user->image;
                    if(File::exists($dest))
                    {
                        File::delete($dest);
                    }
                    $destinationPath = public_path('upload/profiles/');
                    $filename = $request->image->getClientOriginalName();
                    $request->image->move($destinationPath, $filename);
                    $user->image='upload/profiles/'.$filename;
                }
            $user->update();

            return redirect('users')->with('status','Role is Updated');
    }

    public function state($id)
    {
        $user = User::find($id);
        $user->is_delet = '2';
        $user->update();
        return redirect('users');
    }

    public function deletedrecords()
    {
        $users = User::where('is_delet', '2')->get();
        return view('backend.admin.user.deleted',compact('users'));
    }

    public function deletedrestore($id)
    {
        $users = User::find($id);
        $users->is_delet = '0';
        $users->update();
        return redirect('users');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $dest = $user->image;
        if(File::exists($dest))
        {
            File::delete($dest);
        }
        $user->delete();
        return redirect('users');
    }
}
