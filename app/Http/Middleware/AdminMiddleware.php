<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = $request->user();

        // Vérifier si l'utilisateur est authentifié et s'il est administrateur
        if ($user && $user->isAdmin()) {
            // Si l'utilisateur est un administrateur, laissez-le passer
            return $next($request);
        }

        // Si l'utilisateur n'est pas authentifié, redirigez-le vers la page de connexion
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté en tant qu\'administrateur pour accéder à cette page.');
        }

        // Si l'utilisateur est authentifié mais n'est pas un administrateur, redirigez-le vers une page d'erreur ou une autre page appropriée
        return redirect()->route('home')->with('error', 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.');
    }
}
