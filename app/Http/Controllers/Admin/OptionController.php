<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Support\Facades\File;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::all();
        return view('backend.admin.option.options', compact('options'));
    }

    public function store(Request $request)
    {
        //      $request->validate([
        //     'site_name' => 'required',
        //     'site_title' => 'required',
        //     'site_desc' => 'required',
        //     'contact_email' => 'required',
        //     'contact_phone' => 'required',
        //     'site_logo' => 'required',
        //     'footer_text' => 'required',
        //     'currency_format' => 'required',
        //     'contact_address' => 'required',
        //     'site_banner' => 'required',
        // ]);

        // $option = new Option();
        // if($request->file('site_logo'))
        // {
            // $destinationPath = public_path('/upload/logo');
            // $filename = $request->site_logo->getClientOriginalName();
            // $request->site_logo->move($destinationPath, $filename);
            // $option->site_logo= 'upload/logo/'.$filename;

        // $option->site_name = $request->site_name;
        // $option->site_title = $request->site_title;
        // $option->site_desc = $request->site_desc;
        // $option->contact_email = $request->contact_email;
        // $option->contact_phone = $request->contact_phone;
        // $option->footer_text = $request->footer_text;
        // $option->currency_format = $request->currency_format;
        // $option->contact_address = $request->contact_address;
        // $option->save();

        // return redirect('option.options');
    }

    public function edit($id)
    {
        // $option = Option::findorFail($id);
        // return view('admin.options',compact('option'));
    }

    public function update(Request $request, $id)
    {
        //      $request->validate([
        //     'site_name' => 'required',
        //     'site_title' => 'required',
        //     'site_desc' => 'required',
        //     'contact_email' => 'required',
        //     'contact_phone' => 'required',
        //     'site_logo' => 'required',
        //     'footer_text' => 'required',
        //     'currency_format' => 'required',
        //     'contact_address' => 'required',
        //     'site_banner' => 'required',
        // ]);

        $option = Option::findorFail($id);

        if($request->hasfile('site_logo'))
        {
            $dest = $option->site_logo;
            if(File::exists($dest))
            {
                File::delete($dest);
            }
            $destinationPath = public_path('upload/logo/');
            $filename = $request->site_logo->getClientOriginalName();
            $request->site_logo->move($destinationPath, $filename);
            $option->site_logo='upload/logo/'.$filename;
        }
        $option->site_name = $request->site_name;
        $option->site_title = $request->site_title;
        $option->site_desc = $request->site_desc;
        $option->contact_email = $request->contact_email;
        $option->contact_phone = $request->contact_phone;
        $option->footer_text = $request->footer_text;
        $option->currency_format = $request->currency_format;
        $option->contact_address = $request->contact_address;
        $option->update();
        return redirect('options');

    }
}
