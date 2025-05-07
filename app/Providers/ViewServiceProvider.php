<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layout.navbar', function ($view) {
            $demandesNonLues = collect();

            if (Auth::check() && Auth::user()->Profil === 'GERANT') {
                $demandesNonLues = Demande::where('status', 'non_lu')
                    ->whereHas('tontine', function ($query) {
                        $query->where('gerant_id', Auth::id());
                    })
                    ->with(['users', 'tontines'])
                    ->get();
            }

            $view->with('demandesNonLues', $demandesNonLues);
        });
    }

    public function register()
    {
        //
    }
}
