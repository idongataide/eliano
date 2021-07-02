<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class CheckManager
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
        if(Auth::user()->roleid > 2) {
            Flash::error('Sorry, you have no permission to view this.');
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
