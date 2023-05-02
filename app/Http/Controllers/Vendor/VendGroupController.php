<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class VendGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::where('status','!=', '2')->where('vendor_id',Auth::user()->id)->get();
        return view('backend.vendor.group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group;
        return view('backend.vendor.group.create',compact('group'));
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
        return redirect('vendor-groups')->with('status','Group Data Added Successfully');
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
        $group = Group::findorFail($id);
        return view('backend.vendor.group.edit',compact('group'));
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
            'url' => 'required',
            'description' => 'required',
        ]);

        $group = Group::findorFail($id);
        $group->name = $request->name;
        $group->url = $request->url;
        $group->description = $request->description;
        $group->status = $request->input('status') == true ? '1':'0';
        $group->vendor_id = Auth::user()->id;
        $group->update();

        return redirect('vendor-groups')->with('status','Group Data Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function state($id)
    {
        $group = Group::find($id);
        $group->status = '2'; //0->show, 1->hide, 2->delete
        $group->update();
        return redirect('vendor-groups')->with('status','Data Deleted');
    }

    public function deletedrecords()
    {
        $groups = Group::where('status', '2')->get();
        return view('backend.vendor.group.deleted',compact('groups'));
    }

    public function deletedrestore($id)
    {
        $groups = Group::find($id);
        $groups->status = '0';
        $groups->update();
        return redirect('vendor-groups')->with('status','Data Restore');
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect('vendor-groups');
    }

}
