<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerMiddleware
{

    public function handle(Request $request, Closure $next, $guard = 'partner')
    {
        $user = Auth::guard($guard)->user();

        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'You do not have access here',
            ]);
        } else {
            if ($user->status != 1) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Your account has been blocked! Please contact with authority.',
                ]);
            }
        }

        return $next($request);
    }
}
