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
    return $this->hasMany(Cotisation::class, 'idtontine', 'id');
}

public function tirages()
{
    return $this->hasMany(Tirage::class, 'idtontine', 'id');
}

}
