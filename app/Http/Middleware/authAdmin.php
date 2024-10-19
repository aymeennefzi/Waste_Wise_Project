<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class authAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (Auth::check()) {
            // Vérifier le type d'utilisateur
            if (Auth::user()->utype === 'ADM') {
                return $next($request); // Autoriser l'accès
            } else {
                session()->flush(); // Effacer la session
                return redirect('login')->with('message', 'Accès refusé, vous n\'êtes pas un administrateur.'); // Rediriger vers login avec un message
            }
        }

        return redirect('login')->with('message', 'Veuillez vous connecter pour continuer.'); // Rediriger vers login si non authentifié
    }
}
