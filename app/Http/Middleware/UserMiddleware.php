<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserMiddleware
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
        if(Auth::check() && Auth::user()->status)
        {
            $banned = Auth::user()->status == "1";
            Auth::logout();

            if ($banned == 1)
            {
                $message = 'Your Account has Been Banned. Please Contect Administrator.';
            }
            return redirect()->route('login')
                             ->with('status',$message)
                             ->withErrors(['email' => 'Your Account has Been Banned. Please Contect Administrator.']);
        }

        if(Auth::check())
        {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online' . Auth::user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}
