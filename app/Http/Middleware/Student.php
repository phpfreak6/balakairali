<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;

class Student {

    public function handle(Request $request, Closure $next) {
        if (Auth::check() && Auth::user()->isStudent()) {
            return $next($request);
        }
        return redirect(RouteServiceProvider::HOME);
    }

}
