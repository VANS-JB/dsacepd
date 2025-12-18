<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // si pas connecté
        }

        $user = Auth::user();

        // Vérifie si le rôle de l'utilisateur est dans la liste autorisée
        if (!in_array($user->role->libelle, $roles)) {
            abort(403, 'Accès interdit'); // accès refusé
        }

        return $next($request);
    }
}