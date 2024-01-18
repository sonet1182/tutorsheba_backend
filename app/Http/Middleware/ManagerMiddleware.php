<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next, $guard = 'manager')
    {
        if (!Auth::guard($guard)->check() || Auth::guard($guard)->user()->delete_status != 0 || Auth::guard($guard)->user()->logged_in != 1) {
            return redirect('/manager/login');
        }

        return $next($request);
    }
}

