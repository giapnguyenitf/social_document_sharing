<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin() || Auth::user()->isModerator()) {
                return $next($request);
            }

            return redirect()->route('home');
        }

        return redirect()->route('home');
    }
}
