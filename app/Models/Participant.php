<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    // Nom de la table (facultatif si le modèle suit la convention Laravel)
    protected $table = 'participants';
    protected $fillable = [
        'iduser',
        'Adresse',
        'dateNaissance',
        'cni',
        'imageCni',
        'nom',
        

    ];
    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
    // Relation avec le modèle Tontine
    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idtontine');
    }
    // Relation avec le modèle Cotisation
    public function cotisations()
    {
        return $this->hasMany(Cotisation::class, 'idparticipant');
    }
}
