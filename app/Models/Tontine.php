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

    ];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants', 'idtontine', 'iduser');
    }

}
