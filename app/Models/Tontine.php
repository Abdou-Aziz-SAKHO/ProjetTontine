<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    protected $fillable = [
        'datedebut',
        'datefin',
        'montant_total',
        'montant_base',
        'nbreParticipant',
        'frequence',
        'nomtontine',
    ];
    
public function image()
{
    return $this->hasOne(Image::class, 'idtontine'); // 'idtontine' est la clé étrangère dans la table images
}
// Relation avec le modèle Participant
public function participants()
{
    return $this->hasMany(Participant::class, 'idtontine');
}
}
