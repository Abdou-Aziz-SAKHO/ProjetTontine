<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tontine;
use App\Models\Image;
 
    class TontineController extends Controller
    {
        public function index()
{
    // Charger les tontines avec leurs images associées
    $tontines = Tontine::with('image')->get();

    // Retourner la vue avec les tontines
    return view('page.boards.tirages', compact('tontines'));
}
        
    
        public function create()
        {
            return view('page.boards.createTontine');
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'nomImage' => 'required|string|max:255',
                'datedebut' => [
            'required',
            'date',
            'after_or_equal:today', // La date de début doit être aujourd'hui ou après
            function ($attribute, $value, $fail) {
                if (date('Y', strtotime($value)) != 2025) {
                    $fail('La date de début doit être en 2025.');
                }
            },
        ],
        'datefin' =>  'required|date|after:datedebut',
        
                'montant_total' => 'required|numeric|min:0', // Montant total obligatoire et positif
                'montant_base' => 'required|numeric|min:0', // Montant de base obligatoire et positif
                'nbreParticipant' => 'required|integer|min:5', // Nombre de participants minimum 1
                'frequence' => 'required|string|in:hebdomadaire,mensuel,annuel', // Fréquence obligatoire (exemple : hebdomadaire, mensuel, annuel)
            ]);
        
            // Créer une nouvelle tontine avec les données validées
           $tontine = Tontine::create($request->all());
           
            if($tontine){
                $Image = new Image();
                $Image->idtontine = $tontine->id; // Associer l'image à la tontine
                $Image->nomImage = $request->nomImage;
                $Image->save();
                
            }
            // Rediriger vers la liste des tontines avec un message de succès
          return redirect()->route('page.boards.listerlesTontines')->with('success', 'Tontine créée avec succès.');
           
           // Ajouter une tontine avec le statut "active"
          Tontine::create(array_merge($request->all(), ['status' => 'active']));

          return redirect()->route('dashboard')->with('success', 'Tontine créée avec succès.');

        }

        public function listTontines()
        {
              // Récupérer toutes les tontines
               $tontines = Tontine::all();

              // Retourner la vue avec les tontines
           return view('page.boards.cards', compact('tontines'));
        }


        public function destroy($id)
        {
            // Trouver la tontine par son ID
            $tontine = Tontine::findOrFail($id);

            // Vérifier si la tontine a déjà démarré
           if (now()->toDateString() >= $tontine->datedebut) {
             
             // Supprimer les images associées
             $tontine->image()->delete();

            // Supprimer la tontine
            $tontine->delete();
        
            // Rediriger avec un message de succès
            return redirect()->route('page.boards.listerlesTontines')->with('success', 'Tontine supprimée avec succès.');
                }
                 }

         
        public function participants()
        {
                // Récupérer toutes les tontines avec leurs participants et cotisations
                $tontines = Tontine::with(['participants.cotisations'])->get();

               // Retourner la vue avec les données
                return view('page.boards.participants', compact('tontines'));
        }
       
        public function historique()
        {           
    
    // Récupérer les tontines dont le tirage a été effectué et la date de fin est passée
    $tontines = Tontine::where('tirage_effectue', true)
                        ->where('datefin', '<', now())
                        ->get();

    // Retourner la vue avec les tontines filtrées
    return view('page.boards.historique', compact('tontines'));
        }

        public function modifier()
       {
    // Récupérer les tontines qui n'ont pas encore démarré
    $tontines = Tontine::where('datedebut', '>', now())->get();

    // Retourner la vue avec les tontines modifiables
    return view('page.boards.modifier', compact('tontines'));
      }

      public function edit($id)
     {
    // Récupérer la tontine par son ID
    $tontine = Tontine::findOrFail($id);

    // Vérifier si la tontine n'a pas encore démarré
    if ($tontine->datedebut <= now()) {
        return redirect()->route('tontines.modifier')->with('error', 'Cette tontine ne peut pas être modifiée car elle a déjà démarré.');
    }

    // Retourner la vue avec le formulaire de modification
    return view('page.boards.edit', compact('tontine'));
     }

     public function update(Request $request, $id)
     {
    // Valider les données
    $request->validate([
        'nomImage' => 'required|string|max:255',
        'datedebut' => 'required|date|after:today',
        'datefin' => 'required|date|after:datedebut',
        'montant_base' => 'required|numeric|min:0',
        'montant_total' => 'required|numeric|min:0',
        'nbreParticipant' => 'required|integer|min:5',
        'frequence' => 'required|string|in:hebdomadaire,mensuel,annuel',
    ]);

    // Récupérer la tontine
    $tontine = Tontine::findOrFail($id);

    // Mettre à jour les informations
    $tontine->datedebut = $request->datedebut;
    $tontine->datefin = $request->datefin;
    $tontine->montant_base = $request->montant_base;
    $tontine->montant_total= $request->montant_total;
    $tontine->nbreParticipant = $request->nbreParticipant;
    $tontine->frequence = $request->frequence;
    $tontine->save();

     // Mettre à jour le nom de l'image (relation)
     if ($tontine->image) {
        $tontine->image->nomImage = $request->nomImage;
        $tontine->image->save();
    }
    // Rediriger avec un message de succès
    return redirect()->route('tontines.modifier')->with('success', 'Tontine modifiée avec succès.');
    }
    
    //fonction pour afficher les détails d'une tontine
    public function consulter()
    {
        // Récupérer toutes les tontines
        $tontines = Tontine::all();

        // Retourner la vue avec les tontines
        return view('page.boards.consulter', compact('tontines'));
    }
    // Fonction pour afficher les détails d'une tontine spécifique
    public function show($id)
    {
        // Récupérer la tontine par son ID
        $tontine = Tontine::findOrFail($id);

        // Retourner la vue avec les détails de la tontine
        return view('page.boards.details', compact('tontine'));
    }
}
