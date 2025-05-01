<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\Participant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

class TontineController extends Controller
{
    public function index()
    {
        // Récupérer toutes les tontines actives
        // $tontines = Tontine::where('datefin', '>', Carbon::now())->get();
        // Récupérer les tontines dont la date de début est dans le futur ou aujourd'hui
    $tontines = Tontine::where('datedebut', '>=', Carbon::now())->get();

        // Retourner la vue avec les tontines
        return view('page.boards.Tontine', compact('tontines'));
    }




        /**
         * Affiche la page de participation à une tontine.
         *
         * @param int $id L'ID de la tontine.
         * @return \Illuminate\View\View
         */

        public function participer($id)
        {
            $tontine = Tontine::findOrFail($id);
            $user = FacadesAuth::user();
            $participant = Participant::where('iduser', $user->id)->first();

          if (!$user) {
                return redirect()->route('login')->with('error', 'Vous devez être connecté pour participer.');
            }


            if ($tontine->participants()->where('iduser', $user->id)->exists()) {
                return redirect()->route('Tontines')->with('error', 'Vous êtes déjà inscrit à cette tontine.');
            }

             // Insérer uniquement l'idtontine et l'iduser dans la table participants
           DB::table('participants')->insert([
               'idtontine' => $tontine->id,
                 'iduser' => $user->id,
                    'Adresse' => $participant->Adresse,
                    'dateNaissance' => $participant->dateNaissance,
                    'imageCni' => $participant->imageCni,
                       'created_at' => now(),
                 'updated_at' => now(),]);

            // $tontine->participants()->attach($user->id);

            return redirect()->route('Tontines')->with('success', 'Vous avez rejoint la tontine avec succès.');
        }


    public function mesTontines()
    {
        // Récupérer l'utilisateur connecté
        $user = FacadesAuth::user();
        // Récupérer les tontines auxquelles l'utilisateur a participé
        $tontines = $user->tontines;

          // Récupérer les tontines auxquelles l'utilisateur a participé
    $tontines = Tontine::whereHas('participants', function ($query) use ($user) {
        $query->where('iduser', $user->id);
    })->withCount('participants')->get(); // Compter les participants pour chaque tontine


        // Retourner la vue avec les tontines
        return view('page.boards.mestontines', compact('tontines'));
    }


    public function historiqueTontine()
{
    // Récupérer l'utilisateur connecté
    $user = FacadesAuth::user();

    // Récupérer les tontines auxquelles l'utilisateur a participé et dont la date de fin est passée
    $tontines = Tontine::whereHas('participants', function ($query) use ($user) {
        $query->where('iduser', $user->id);
    })
    ->where('datefin', '<', Carbon::now()) // Condition : date de fin passée
    ->withCount('participants') // Compter les participants pour chaque tontine
    ->get();

    // Retourner la vue avec les tontines
    return view('page.boards.historiqueParticipant', compact('tontines'));
}

public function seRetirer($id)
{
    $tontine = Tontine::findOrFail($id); // Trouver la tontine par son ID
    $user = FacadesAuth::user(); // Récupérer l'utilisateur connecté

    // Vérifier si la date de début de la tontine est dans le futur
    if ($tontine->datedebut <= Carbon::now()) {
        return redirect()->route('Tontines')->with('error', 'Vous ne pouvez pas vous retirer d\'une tontine qui a déjà commencé
        veulliez Contactez l\'administrateur .');
    }

    // Supprimer l'utilisateur de la table participants
    DB::table('participants')
        ->where('idtontine', $tontine->id)
        ->where('iduser', $user->id)
        ->delete();

    return redirect()->route('Tontines')->with('success', 'Vous vous êtes retiré de la tontine avec succès.');
}

}
