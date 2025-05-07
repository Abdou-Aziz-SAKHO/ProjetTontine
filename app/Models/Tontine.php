<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tontine extends Model
{
    protected $fillable = [
        'nom_tontine',
        'datedebut',
        'datefin',
        'montant_total',
        'montant_base',
        'nbreParticipant',
        'frequence',
        'gerant_id' ,// ← ajoute ceci si tu fais $request->all()
    ];



    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants', 'idtontine', 'iduser');
    }



public function image()
{
    return $this->hasOne(Image::class, 'idtontine'); // 'idtontine' est la clé étrangère dans la table images
}
// Relation avec le modèle Participant
public function participant()
{
    return $this->hasMany(Participant::class, 'idtontine');
}

public function cotisations()
{
    return $this->hasMany(cotisation::class, 'idtontine', 'id');
}

public function tirages()
{
    return $this->hasMany(tirage::class, 'idtontine', 'id');
}

public function gerant()
{
    return $this->belongsTo(User::class, 'gerant_id');
}

public function demandes()
{
    return $this->hasMany(Demande::class, 'tontine_id');
}

public function getNextPaymentDate()
    {
        // Récupérer la date de début de la tontine
        $startDate = Carbon::parse($this->datedebut);

        // Calculer la prochaine date de paiement en fonction de la fréquence
        switch ($this->frequence) {
            case 'HEBDOMADAIRE':
                return $startDate->addWeeks(1); // Ajouter 1 semaine
            case 'MENSUELLE':
                return $startDate->addMonth(); // Ajouter 1 mois
            case 'ANNUELLE':
                return $startDate->addYear(); // Ajouter 1 an
            default:
                return $startDate;
        }
    }

}
