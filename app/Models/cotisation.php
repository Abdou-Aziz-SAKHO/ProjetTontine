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
}
