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
        $user = $request->user();

        // Les routes où les utilisateurs normaux peuvent avoir des permissions
        $allowedRoutesForUsers = [
            'posts.edit', 
            'posts.update', 
            'posts.destroy'
        ];

        if ($user && $user->isAdmin()) {
            return $next($request);
        } elseif ($user && in_array($request->route()->getName(), $allowedRoutesForUsers)) {
            // Vérifier ici si l'utilisateur est autorisé (par exemple, il est le propriétaire du post)
            return $next($request);
        }

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return redirect()->route('home')->with('error', 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.');
    }

}
