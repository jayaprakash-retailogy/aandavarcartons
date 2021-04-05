<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionMiddleware
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
        $session = session()->has('id');
        $logged_in = session()->has('is_logged');

		if(Auth::check()) {
            return $next($request);
            return redirect('/');
		}
        elseif($session == '' && $logged_in == '') {
            return redirect('/');
        }
        else {
			return redirect('/');
		}
    }
}
