<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissaoDeGrupo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $grupo = $request->route('grupo');
        if (auth()->user()->can('view', $grupo)) {
            return $next($request);
        }
        abort(403, "Não Autorizado");

    }
}
