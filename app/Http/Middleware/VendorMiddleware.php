<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->role == 'Vendor')
        {
            if(Auth::check() && Auth::user()->status)
            {
                $banned = Auth::user()->status == '1';
                Auth::logout();

                if ($banned == 1)
                {
                    $message = 'Your Account has Been Banned. Please Contect Administrator.';
                }
                return redirect()->route('login')
                                 ->with('status',$message)
                                 ->withErrors(['email' => 'Your Account has Been Banned. Please Contect Administrator.']);

            }
            return $next($request);
        }
        else
        {
            return redirect('/')->with('status','You are Not Allowed to access this Account');
        }
        return $next($request);
    }
}
