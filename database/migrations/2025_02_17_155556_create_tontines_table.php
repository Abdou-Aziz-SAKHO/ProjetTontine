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
            $table->date('datedebut');
            $table->date('datefin');
            $table->integer('montant_Total');
            $table->integer('montant_base');
            $table->integer('nbreParticipant');
            $table->enum('frequence',
        [
            
            'HEBDOMADAIRE',
            'MENSUELLE',
            'ANNUELLE'
        ]);
          
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
