<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->role_id == 2 )
        {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Your Account is not admin, please enter as admin.');
        }

        return $next($request);

    }
}

