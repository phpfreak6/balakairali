<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;

class Admin
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

        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);

        }elseif(Auth::check() && Auth::user()->isTeacher()){

            return abort(403, 'You cannot access this route.');
            
        }elseif(Auth::check() && Auth::user()->isStudent()){
        
                return abort(403, 'You cannot access this route.');
        }

        return redirect(RouteServiceProvider::ADMIN_LOGIN);
    }
}
