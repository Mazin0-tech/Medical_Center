<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        if (Auth::check()) {
            // Split the roles into an array
            $roles = explode('|', $roles);

            // Check if the user's role exists in the array of allowed roles
            if (in_array(Auth::user()->role, $roles)) {
                // Check if the user is blocked
                if (Auth::user()->status === 'blocked') {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['message' => 'Your account is blocked. Contact admin.']);
                }

                return $next($request);
            }

            // Restrict access if the user doesn't have the required role
            return redirect()->route('welcome')->with('error', 'Unauthorized access');
        }

        // If the user is not logged in, redirect to the login page
        return redirect()->route('login');
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Redirect to login if unauthenticated
        }
    }
}
