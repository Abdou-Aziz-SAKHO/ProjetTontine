<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('demandes', function (Blueprint $table) {
        $table->string('status')->default('non_lu');  // Ajouter un champ 'status' avec la valeur par défaut 'non_lu'
    });
}

public function down()
{
    Schema::table('demandes', function (Blueprint $table) {
        $table->dropColumn('status');  // Supprimer la colonne 'status' si la migration est annulée
    });
}

};
