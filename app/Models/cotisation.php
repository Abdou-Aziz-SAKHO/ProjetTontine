<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cotisation extends Model
{
    protected $fillable = [

        'iduser',
        'idtontine',
        'montant',
        'mode_paiement',

    ];


    public function participant()
{
    return $this->belongsTo(Participant::class, 'idparticipant');
}

public function tontine()
{
    return $this->belongsTo(Tontine::class, 'idtontine', 'id');
}
}
