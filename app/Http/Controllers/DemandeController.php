<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::with(['user', 'tontine'])->get(); // tu peux filtrer si nécessaire
        return view('page.demandes.index', compact('demandes'));
    }
}
