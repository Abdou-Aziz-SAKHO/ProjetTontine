<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HashPasswords extends Command

{
    protected $signature = 'passwords:hash';
    protected $description = 'Hasher les mots de passe non sécurisés dans la base de données';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Vérifier si le mot de passe n'est pas déjà hashé
            if (!Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
                $user->save();
                $this->info("Mot de passe hashé pour l'utilisateur : {$user->email}");
            }
        }

        $this->info('Tous les mots de passe non sécurisés ont été hashés.');
    }
}
