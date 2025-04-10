<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isAdmin

{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && (Auth::user()->Profil=='SUPER_ADMI' || Auth::user()->Profil=='GERANT')) {

            return $next($request);
        }
        else{
         // Redirect to the login page or show an error message
         return redirect('/connexion')->with('error', 'Access denied. You do not have admin privileges.');
    }
}}
