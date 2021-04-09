<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
       
            if (Auth::check()) {
                if(Auth::user()->isAdmin()){
                    return redirect(RouteServiceProvider::ADMIN);
                }elseif(Auth::user()->isTeacher()){
                    return redirect(RouteServiceProvider::ADMIN);
                }elseif(Auth::user()->isStudent()){
                    return redirect(RouteServiceProvider::PIN);
                }
            }
        

        return $next($request);
    }
}
