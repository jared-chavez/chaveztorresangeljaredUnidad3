<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Verificar si el usuario tiene el rol requerido
        if (Auth::user()->role !== $role) {
            // Redirige al dashboard correspondiente si no tiene el rol
            $dashboardRoute = match(Auth::user()->role) {
                'admin' => '/admin/dashboard',
                'sales' => '/sales/dashboard',
                'customer' => '/dashboard',
                default => '/',
            };
            return redirect($dashboardRoute)
                ->with('error', 'No tienes permiso para acceder a esa sección.');
        }

        return $next($request);
    }
}