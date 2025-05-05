<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\Request;

abstract class Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); // Récupérer la requête de recherche

        // Rechercher dans les utilisateurs
        $users = User::where('nom', 'LIKE', "%$query%")
            ->orWhere('prenom', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get();

        // Rechercher dans les tontines
        $tontines = Image::where('nomimage', 'LIKE', "%$query%")
            ->orWhere('frequence', 'LIKE', "%$query%")
            ->get();

        // Retourner les résultats à une vue
        return view('results', compact('users', 'tontines', 'query'));
    }
}
