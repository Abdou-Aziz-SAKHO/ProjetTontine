<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tontines', function (Blueprint $table) {
            $table->id();
            $table->string('nom_tontine');
            $table->date('datedebut');
            $table->date('datefin');
            $table->unsignedInteger('montant_total');
            $table->unsignedInteger('montant_base');
            $table->unsignedInteger('nbreParticipant');
            $table->enum('frequence', ['HEBDOMADAIRE', 'MENSUELLE', 'ANNUELLE']);
            $table->timestamps();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tontines');
    }


};
