<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Vérifie que l'utilisateur est connecté et qu'il est SuperAdmin
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Accès réservé au Super Administrateur.');
        }

        return $next($request);
    }
}
