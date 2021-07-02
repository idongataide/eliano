<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class CheckOfficer
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
        if(Auth::user()->roleid > 3) {
            Flash::error('Sorry, you have no permission to view this.');
            return redirect('/home');
        }
        return $next($request);
    }
}
