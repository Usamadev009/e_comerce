<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        return view ('backend.admin.index');
    }

    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }

    public function change_password()
    {
        return view('backend.change_password');
    }
}
