<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
             'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',

        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message'=>'errors',
                'errors' => ["error" => trans('messages.invalid_credentials')]
            ], 401);
        }


        $user = $request->user();
        if($user->role == 'Admin' )
        {
            $tokenResult = $user->createToken('Rxmf7l8rSvdgWz8K0jotR5pr92tEkcJFkqvz3KPQ');
            $token = $tokenResult->token;
            $token->save();
            return view('backend.admin.dashboard')->with('status','Welcome to Dashboard');

        }
        elseif($user->role =='Vendor')
        {
            return view('backend.vendor.dashboard')->with('status','Welcome to Dashboard');
        }
        else
        {
            return redirect()->back()->with('status','You are Logged in successfully');
        }

    }
}
