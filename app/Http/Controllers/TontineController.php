<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\cotisation;
use App\Models\Participant;
use App\Models\User;
use App\Models\Image;
use Carbon\Carbon;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TontineController extends Controller
{
    public function index()
    {
        $tontines = Tontine::where('datedebut', '>=', Carbon::now())->get();
        return view('page.boards.Tontine', compact('tontines'));
    }

    public function participer($id)
    {
        $tontine = Tontine::findOrFail($id);
        $user = Auth::user();
        $participant = Participant::where('iduser', $user->id)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour participer.');
        }

        if ($tontine->participants()->where('iduser', $user->id)->exists()) {
            return redirect()->route('Tontines')->with('error', 'Vous êtes déjà inscrit à cette tontine.');
        }

        DB::table('participants')->insert([
            'idtontine' => $tontine->id,
            'iduser' => $user->id,
            'Adresse' => $participant->Adresse,
            'dateNaissance' => $participant->dateNaissance,
            'imageCni' => $participant->imageCni,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('Tontines')->with('success', 'Vous avez rejoint la tontine avec succès.');
    }
    public function mesTontines()
{
    $user = Auth::user();

    // Récupérer les tontines auxquelles l'utilisateur participe
    $tontines = Tontine::whereHas('participants', function ($query) use ($user) {
        $query->where('iduser', $user->id);
    })->withCount('participants')->get();

    // Récupérer les demandes non lues pour l'utilisateur connecté
    $demandesNonLues = Demande::where('status', 'non_lu')  // Filtrer par 'status' = 'non_lu'
                              ->where('user_id', $user->id) // Condition pour l'utilisateur connecté
                              ->whereHas('tontine', function ($query) {
                                  $query->where('gerant_id', Auth::id()); // Vérifier que l'utilisateur est le gérant
                              })
                              ->with(['user', 'tontine']) // Charger les relations
                              ->get();

    // Transmettre à la vue
    return view('page.boards.mestontines', compact('tontines', 'demandesNonLues'));
}


    public function historiqueTontine()
    {
        $user = Auth::user();
        $tontines = Tontine::whereHas('participants', function ($query) use ($user) {
            $query->where('iduser', $user->id);
        })->where('datefin', '<', Carbon::now())->withCount('participants')->get();

        return view('page.boards.historiqueParticipant', compact('tontines'));
    }

    public function seRetirer($id)
    {
        $tontine = Tontine::findOrFail($id);
        $user = Auth::user();

        if ($tontine->datedebut <= Carbon::now()) {
            return redirect()->route('Tontines')->with('error', 'Vous ne pouvez pas vous retirer d\'une tontine qui a déjà commencé. Veuillez contacter l\'administrateur.');
        }

        DB::table('participants')
            ->where('idtontine', $tontine->id)
            ->where('iduser', $user->id)
            ->delete();

        return redirect()->route('Tontines')->with('success', 'Vous vous êtes retiré de la tontine avec succès.');
    }

    public function indexe()
    {
        $tontines = Tontine::with('image')->get();
        return view('page.boards.tirages', compact('tontines'));
    }

    public function create()
    {
        return view('page.boards.createTontine');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_tontine' => 'required|string|max:255',
            'nomImage' => 'required|string|max:255',
            'datedebut' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    if (date('Y', strtotime($value)) != 2025) {
                        $fail('La date de début doit être en 2025.');
                    }
                },
            ],
            'datefin' => 'required|date|after:datedebut',
            'montant_total' => 'required|numeric|min:0',
            'montant_base' => 'required|numeric|min:0',
            'nbreParticipant' => 'required|integer|min:5',
            'frequence' => 'required|string|in:HEBDOMADAIRE,MENSUELLE,ANNUELLE',
        ]);

        // Ajouter gerant_id manuellement dans les données de la requête
        $data = $request->all();
        $data['gerant_id'] = Auth::id(); // Assure-toi d'avoir 'use Auth;' en haut du fichier

        // Créer la tontine avec les données, y compris le gerant_id
        $tontine = Tontine::create($data);

        if ($tontine) {
            $image = new Image();
            $image->idtontine = $tontine->id;
            $image->nomImage = $request->nomImage;
            $image->save();
        }

        return redirect()->route('page.boards.listerlesTontines')->with('success', 'Tontine créée avec succès.');
    }

    public function listTontines()
    {
        $tontines = Tontine::all();
        return view('page.boards.cards', compact('tontines'));
    }

    public function destroy($id)
    {
        $tontine = Tontine::findOrFail($id);

        if (now()->toDateString() >= $tontine->datedebut) {
            $tontine->image()->delete();
            $tontine->delete();

            return redirect()->route('page.boards.listerlesTontines')->with('success', 'Tontine supprimée avec succès.');
        }
    }

    public function participants()
    {
        $users = User::with(['tontines', 'cotisations.tontine'])->get();
        return view('page.boards.participants', compact('users'));
    }

    public function historique()
    {
        $tontines = Tontine::where('datefin', '<', now())->get();
        return view('page.boards.historique', compact('tontines'));
    }

    public function modifier()
    {
        $tontines = Tontine::where('datedebut', '>', now())->get();
        return view('page.boards.modifier', compact('tontines'));
    }

    public function edit($id)
    {
        $tontine = Tontine::findOrFail($id);

        if ($tontine->datedebut <= now()) {
            return redirect()->route('tontines.modifier')->with('error', 'Cette tontine ne peut pas être modifiée car elle a déjà démarré.');
        }

        return view('page.boards.edit', compact('tontine'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_tontine' => 'required|string|max:255',
            'nomImage' => 'required|string|max:255',
            'datedebut' => 'required|date|after:today',
            'datefin' => 'required|date|after:datedebut',
            'montant_base' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'nbreParticipant' => 'required|integer|min:5',
            'frequence' => 'required|string|in:hebdomadaire,mensuel,annuel',
        ]);

        $tontine = Tontine::findOrFail($id);

        $tontine->update([
            'nom_tontine' => $request->nom_tontine,
            'datedebut' => $request->datedebut,
            'datefin' => $request->datefin,
            'montant_base' => $request->montant_base,
            'montant_total' => $request->montant_total,
            'nbreParticipant' => $request->nbreParticipant,
            'frequence' => $request->frequence,
        ]);

        if ($tontine->image) {
            $tontine->image->update([
                'nomImage' => $request->nomImage,
            ]);
        }

        return redirect()->route('tontines.modifier')->with('success', 'Tontine mise à jour avec succès.');
    }
    public function cotisation($id)
{
    $tontine = Tontine::findOrFail($id);
    $user = Auth::user();

    // Vérifier si l'utilisateur est déjà inscrit à la tontine
    $participant = $tontine->participants()->where('iduser', $user->id)->first();

    if (!$participant) {
        return redirect()->route('Tontines')->with('error', 'Vous devez d\'abord participer à cette tontine.');
    }

    // Calculer le prochain paiement en fonction de la fréquence
    $nextPaymentDate = $this->getNextPaymentDate($tontine->frequence);

    return view('page.boards.paiement', compact('tontine', 'nextPaymentDate'));
}

private function getNextPaymentDate($frequence)
{
    $today = Carbon::now();

    switch ($frequence) {
        case 'hebdomadaire':
            return $today->addWeek();  // Prochain paiement dans 1 semaine
        case 'mensuel':
            return $today->addMonth();  // Prochain paiement dans 1 mois
        case 'annuel':
            return $today->addYear();  // Prochain paiement dans 1 an
        default:
            return $today;
    }
}


    public function consulter()
    {
        $tontines = Tontine::all();
        return view('page.boards.consulter', compact('tontines'));
    }

    public function show($id)
    {
        $tontine = Tontine::findOrFail($id);
        return view('page.boards.details', compact('tontine'));
    }

    public function updateTontine(Request $request, $id)
    {
        $request->validate([
            'nom_tontine' => 'required|string|max:255',
            'nomImage' => 'required|string|max:255',
            'datedebut' => 'required|date',
            'datefin' => 'required|date|after_or_equal:datedebut',
            'montant_base' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'frequence' => 'required|in:hebdomadaire,mensuel,annuel',
            'nbreParticipant' => 'required|integer|min:1',
        ]);

        $tontine = Tontine::findOrFail($id);

        $tontine->update([
            'nom_tontine' => $request->input('nom_tontine'),
            'datedebut' => $request->input('datedebut'),
            'datefin' => $request->input('datefin'),
            'montant_base' => $request->input('montant_base'),
            'montant_total' => $request->input('montant_total'),
            'frequence' => $request->input('frequence'),
            'nbreParticipant' => $request->input('nbreParticipant'),
        ]);

        if ($tontine->image) {
            $tontine->image->update([
                'nomImage' => $request->input('nomImage'),
            ]);
        }

        return redirect()->route('tontines.modifier')->with('success', 'Tontine mise à jour avec succès.');
    }
    public function indexDemande()
{
    $demandesNonLues = Demande::where('lu', '')->with('user', 'tontine')->get();
    $tontines = Tontine::where('datedebut', '>=', now())->get();

    return view('page.boards.Tontine', [
        'tontines' => $tontines,
        'demandesNonLues' => $demandesNonLues
    ]);
}




public function generateCotisationsForTontine($tontineId)
{
    $tontine = Tontine::find($tontineId);

    // Vérifier si la tontine existe
    if (!$tontine) {
        return redirect()->back()->with('error', 'Tontine non trouvée');
    }

    // Récupérer tous les participants de la tontine
    $participants = Participant::where('idtontine', $tontineId)->get();

    // Récupérer la prochaine date de paiement
    $nextPaymentDate = $tontine->getNextPaymentDate();

    // Enregistrer une cotisation pour chaque participant
    foreach ($participants as $participant) {
        // Créer un enregistrement de cotisation
        cotisation::create([
            'idparticipant' => $participant->id,
            'tontine_id' => $tontine->id,
            'montant' => $tontine->montant_base, // Montant de base de la tontine
            'date_paiement' => $nextPaymentDate,
            'est_paye' => false, // La cotisation n'est pas encore payée
        ]);
    }

    return redirect()->back()->with('success', 'Cotisations générées pour tous les participants.');
}

}
