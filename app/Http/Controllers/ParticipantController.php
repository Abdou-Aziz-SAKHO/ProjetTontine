<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function showParticipants()
    {
        // Filtrer les utilisateurs avec le profil "Participants"
        $users = User::where('Profil', 'PARTICIPANT')->get();

        return view('page.boards.participants', compact('users'));
    }

    // public function index()
    // {
    //     $users = User::with('tontines')->get(); // Charge les tontines associées
    //     return view('page.boards.participants', compact('users'));
    // }

    public function details($id)
    {
        $user = User::with('tontines.cotisations')->findOrFail($id); // Charge les tontines et leurs cotisations
        return view('page.boards.userdetails', compact('user'));
    }


}
