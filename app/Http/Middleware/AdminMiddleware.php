<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    // public function handle(Request $request, Closure $next, $guard = 'admin')
    // {
    //     if (!Auth::guard($guard)->check()) {
    //         return redirect('/admin/login');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, $guard = 'admin')
    {
        $user = Auth::guard($guard)->user();

        if (!$user) {
            return redirect('/admin/login');
        } else {
            if ($user->logged_in != 1) {
                return redirect('/admin/login');
            }
        }

        return $next($request);
    }
}
