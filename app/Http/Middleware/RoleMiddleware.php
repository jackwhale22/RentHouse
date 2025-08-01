<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect based on user role if they don't have access
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        } elseif ($user->isPemilik()) {
            return redirect('/pemilik/dashboard');
        } else {
            return redirect('/dashboard');
        }
    }
}
