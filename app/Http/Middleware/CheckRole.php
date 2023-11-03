<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $admin, $staff, $customer)
    {
        if (!Auth::check()) {
            return Redirect::route("login");
        }

        $role = Auth::user()->role;
    
        if ($role === $admin || $role === $staff || $role === $customer) {
            return $next($request);
        }
    
        return abort(403);
    }
}
