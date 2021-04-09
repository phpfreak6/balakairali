<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
       if (Auth::guest()) {

            return abort(403, 'User is not logged in.');
        }

        $roles = explode('|', $role);
        
        if (! in_array(User::role(), $roles) || ! in_array(User::role(), $roles)) {
            return abort(403, 'You cannot access this route.');
        }

        return $next($request);
    }
}
