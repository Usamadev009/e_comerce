<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::where('status','!=', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.admin.group.index',compact('groups'));
    }

    public function create()
    {
        $group = new Group;
        return view('backend.admin.group.create',compact('group'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:groups',
            'url' => 'required',
            'description' => 'required',
        ]);
        $group = new Group();
        $group->name = $request->name;
        $group->url = $request->url;
        $group->description = $request->description;

        if($request->input('status') == true)
        {
            $group->status = "1";
        }
        else
        {
            $group->status = "0";
        }

        $group->vendor_id = Auth::user()->id;
        $group->save();
        return redirect('groups')->with('status','Group Data Added Successfully');
    }

    public function edit($id)
    {
        $group = Group::findorFail($id);
        return view('backend.admin.group.edit',compact('group'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'required',
            'description' => 'required',
        ]);

        $group = Group::findorFail($id);
        $group->name = $request->name;
        $group->url = $request->url;
        $group->description = $request->description;
        $group->status = $request->input('status') == true ? '1':'0';
        $group->update();
        return redirect('groups')->with('status','Group Data Updated Successfuly.');
    }

    public function state($id)
    {
        $group = Group::find($id);
        $group->status = '2'; //0->show, 1->hide, 2->delete
        $group->update();
        return redirect('groups')->with('status','Data Deleted');
    }

    public function deletedrecords()
    {
        $groups = Group::where('status', '2')->get();
        return view('backend.admin.group.deleted',compact('groups'));
    }

    public function deletedrestore($id)
    {
        $groups = Group::find($id);
        $groups->status = '0';
        $groups->update();
        return redirect('groups')->with('status','Data Restore');
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect('groups');
    }
}
