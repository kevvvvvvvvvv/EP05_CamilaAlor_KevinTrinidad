<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado usando el guard "empleado"
        if (!Auth::guard('empleado')->check()) {
            // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('login');
        }

        // Si está autenticado, permitir que continúe con la solicitud
        return $next($request);
    }
}

