<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    public function create(){
        return view('page.Auth.Auth');
    }

    public function auth(Request $request){
        $auth= $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',

        ]);
        // if (Auth::attempt($auth)){
        //     $request->session()->regenerate();
        //     return redirect()->route('home');
           if (Auth::attempt($auth)){
            $request->session()->regenerate();
            if (Auth::user()->Profil=='SUPER_ADMI' || Auth::user()->Profil=='GERANT'){
                return redirect()->route('dashboard');
            }
            elseif (Auth::user()->Profil=='PARTICIPANT'){
                return redirect()->route('home');
            }
            }
        return back()->with('error','email ou mot de passe invalide');

    }
    public function forgot(){
        return view('page.Auth.forgot');
    }
    public function Dashboard(){
        return view('page.boards.Dashboard');
    }
}
