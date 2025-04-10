<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    //permet d'acceder au vue index
   public function index(){
        return view('page.inscription.index');
   }

   public function home(){
    return view('welcome');
}

//permet de valider le formulaire
   public function register(Request $request){
$request->validate([
    'prenom'=>'required|min:3',
    'nom'=>'required|min:2',
    'email'=>'required|email|unique:users',
    'telephone'=>'required|max:9|unique:users',
    'dateNaissance'=>'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),
    'cni'=>'required|min:13|max:13',
    'Adresse'=>'required|string',
    'password'=>'required|min:6|confirmed',



]);
// Enrigistrer dans la base de donnees
$user = User::create(
    [
        'prenom' =>$request->prenom,
        'nom' =>$request->nom,
        'telephone' =>$request->telephone,
        'email' =>$request->email,
        'password' =>bcrypt($request->password),

    ]
    );
  //Enrigistrer un aprticipant si l'inscription est bon
     if ($user){
        $participant = new Participant();
        $participant->iduser = $user->id;
        $participant->dateNaissance = $request->dateNaissance;
        $participant->cni = $request->cni;
        $participant->Adresse = $request->Adresse;
        $participant->save();

        //Authentification
         $request->session()->regenerate();
         //Redirection
         return redirect()->route('auth.create')->with('success','inscription reussi');

        }


         return back()->with('error',"une erreur s'est produit");
    }



}
