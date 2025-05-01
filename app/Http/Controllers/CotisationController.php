<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\Participant;
use App\Models\User;
use Carbon\Carbon;
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

}
