<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Clé étrangère vers la table 'users'
            $table->foreignId('tontine_id')->constrained('tontines')->onDelete('cascade');  // Clé étrangère vers la table 'tontines'
            $table->boolean('lu')->default(false);  // Champ pour indiquer si la demande a été lue
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
