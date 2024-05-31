<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsuarioAtivoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && !auth()->user()->ativo) {
            auth()->logout();
            return redirect()->route('filament.admin.auth.login')->withErrors(['email' => 'Sua conta não está ativa']);
        }
        return $next($request);
    }
}
