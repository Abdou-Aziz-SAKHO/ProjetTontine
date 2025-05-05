<?php

namespace App\Http\Controllers;

use App\Models\cotisation;
use App\Models\Image;
use App\Models\Tontine;
use App\Models\Participant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;


class CotisationController extends Controller
{
    public function paiement($id)
{
    $tontine = Tontine::findOrFail($id); // Trouver la tontine par son ID
    $user = FacadesAuth::user(); // Récupérer l'utilisateur connecté

    // Vérifier si l'utilisateur participe à cette tontine
     DB::table('participants')
        ->where('idtontine', $tontine->id)
        ->where('iduser', $user->id)
        ->exists();

    // if (!$isParticipant) {
    //     return redirect()->route('Tontines')->with('error', 'Vous ne participez pas à cette tontine.');
    // }

    // Retourner la vue de paiement
    return view('page.boards.payement', compact('tontine'));
}

public function processPaiement(Request $request, $id)
{
    $tontine = Tontine::findOrFail($id);
    $user = FacadesAuth::user();

    // Vérifier si l'utilisateur participe à cette tontine
    $isParticipant = DB::table('participants')
        ->where('idtontine', $tontine->id)
        ->where('iduser', $user->id)
        ->exists();

    if (!$isParticipant) {
        return redirect()->route('Tontines')->with('error', 'Vous ne participez pas à cette tontine.');
    }
      // Valider le mode de paiement
      $request->validate([
        'mode_paiement' => 'required|string|max:255',
    ]);

    // Simuler le traitement du paiement
     // Simuler le traitement du paiement
     $montant = $tontine->montant_base; // Montant à payer (par exemple, montant de base de la tontine)

     // Enregistrer le paiement dans la table paiements
     DB::table('cotisations')->insert([
         'idtontine' => $tontine->id,
         'iduser' => $user->id,
         'montant' => $montant,
         'mode_paiement' => $request->input('mode_paiement'), // Récupérer le mode de paiement depuis le formulaire
         'created_at' => now(),
         'updated_at' => now(),
     ]);
    // Vous pouvez ajouter une logique pour enregistrer le paiement dans une table dédiée

     // Retourner un message de succès
     return redirect()->route('Tontines')->with('success', 'Votre paiement de ' . $montant . ' FCFA a été effectué avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Récupérer la requête de recherche

        // Rechercher dans les utilisateurs
        $users = User::where('nom', 'LIKE', "%$query%")
            ->orWhere('prenom', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get();

        // Rechercher dans les tontines
        $tontines = Tontine::whereHas('image', function ($q) use ($query) {
            $q->where('nomImage', 'LIKE', "%$query%");
        })
        ->orWhere('frequence', 'LIKE', "%$query%")
        ->get();

        // Retourner les résultats à une vue
        return view('results', compact('users', 'tontines', 'query'));
    }

    public function mesTransactions()
    {
        // Récupérer les cotisations de l'utilisateur connecté
        $userId = FacadesAuth::user()->id; // ID de l'utilisateur connecté
        $cotisations = cotisation::where('iduser', $userId)
            ->with('tontine') // Charger la relation avec les tontines
            ->get();

        return view('page.boards.mestransaction', compact('cotisations'));
    }

}
