<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        if (!auth()->user()->administrador) {
            return response()->json(['error' => 'Acesso negado. Apenas administradores podem acessar este recurso.'], 403);
        }

        return $next($request);
    }
}
