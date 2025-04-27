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
        // Ajout de la colonne 'nomtontine' à la table 'tontines'
        Schema::table('tontines', function (Blueprint $table) {
            $table->string('nomtontine')->after('id'); // Ajoute la colonne après l'ID
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Suppression de la colonne 'nomtontine' de la table 'tontines'
        Schema::table('tontines', function (Blueprint $table) {
            $table->dropColumn('nomtontine');
        });
    }
};