<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class CheckAnyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
/*     public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    } */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = Auth::guard('empleado')->user();
        
        if ($user instanceof Empleado) { // Verifica que el usuario sea una instancia de Empleado
            foreach ($permissions as $permission) {
                if ($user->can($permission)) {
                    return $next($request); // Permiso concedido si tiene al menos uno
                }
            }
        }
        abort(403); // Permiso denegado si no tiene ninguno de los permisos
    } 
}
