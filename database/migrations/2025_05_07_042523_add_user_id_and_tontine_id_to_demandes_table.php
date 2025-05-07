<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdAndTontineIdToDemandesTable extends Migration
{
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Ajouter la colonne 'user_id' pour lier chaque demande à un utilisateur
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Ajouter la colonne 'tontine_id' pour lier chaque demande à une tontine
            $table->foreignId('tontine_id')->constrained('tontines')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Supprimer les colonnes 'user_id' et 'tontine_id'
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['tontine_id']);
            $table->dropColumn('tontine_id');
        });
    }
}
