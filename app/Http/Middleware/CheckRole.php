<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$role) {
        $user = Auth::user();

        if( $user && in_array($user->role, $role) ) {
            return abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
