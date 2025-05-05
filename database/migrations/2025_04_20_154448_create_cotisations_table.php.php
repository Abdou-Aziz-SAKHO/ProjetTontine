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
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idtontine')->nullable();;
            // $table->primary('iduser','idtontine');
             $table->integer('montant');
            $table->enum('mode_paiement',['ESPECE','WAVE','OM']);
            $table->timestamps();

            $table->foreign('iduser')->references('id')->on('users') ->onDelete('cascade');
            $table->foreign('idtontine')->references('id')->on('tontines') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotisations', function (Blueprint $table) {
            $table->dropForeign(['iduser']);
            $table->dropForeign(['idtontine']);
        });

        Schema::dropIfExists('cotisations');
    }};
