<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdministrateur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'Administrateur') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette ressource.');
    }
}
