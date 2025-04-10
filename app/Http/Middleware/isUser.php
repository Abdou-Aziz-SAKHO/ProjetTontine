<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->Profil=='PARTICIPANT') {

            return $next($request);

        }
        else{
         // Redirect to the login page or show an error message
         return redirect('/connexion')->with('error', 'Access denied. You do not have user privileges.');
    }
    }
}
