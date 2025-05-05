<?php
namespace App\Http\Controllers;

use App\Models\tirage;
use Illuminate\Http\Request;
use App\Models\Tontine;

class TirageController extends Controller
{
    public function index()
    {
        // Récupérer toutes les tontines
        $tontines = Tontine::all();

        // Retourner la vue avec les tontines
        return view('page.boards.tirages', compact('tontines'));
    }


    public function tirer(Request $request, $id)
    {
        // Récupérer la tontine par son ID
        $tontine = Tontine::findOrFail($id);

        // Vérifier si la date actuelle correspond à la date de fin
        if (now()->toDateString() == $tontine->datefin) {
            return redirect()->route('tirage.index')->with('error', 'Le tirage ne peut être effectué qu\'à la date de fin de la tontine.');
        }

        // Récupérer les participants associés à cette tontine
        $participants = $tontine->participants;

        if ($participants->isEmpty()) {
            return redirect()->back()->with('error', "Aucun participant disponible pour le tirage de la tontine : {$tontine->nomtontine}.");
        }

        // Filtrer les participants pour exclure ceux qui ont déjà gagné dans cette tontine
        $participantsEligibles = $participants->filter(function ($participant) use ($tontine) {
            return !$tontine->tirages()->where('iduser', $participant->id)->exists();
        });

        if ($participantsEligibles->isEmpty()) {
            return redirect()->back()->with('error', "Tous les participants ont déjà gagné dans la tontine : {$tontine->nomtontine}.");
        }

        // Sélectionner un gagnant aléatoire parmi les participants éligibles
        $gagnant = $participantsEligibles->random();

        // Enregistrer le gagnant dans la table Tirage
        tirage::create([
            'iduser' => $gagnant->id,
            'idtontine' => $tontine->id,
        ]);

        // Retourner un message de succès
        return redirect()->back()->with('success', "Le gagnant pour la tontine '{$tontine->nomtontine}' est : {$gagnant->nom} {$gagnant->prenom}.");
    }
}
