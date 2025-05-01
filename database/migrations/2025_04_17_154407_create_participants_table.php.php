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

  // Vérifiez si les tables 'users' et 'tontines' existent
  if (!Schema::hasTable('users') || !Schema::hasTable('tontines')) {
    throw new \Exception('Les tables "users" et "tontines" doivent être créées avant "participants".');
  }



        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idtontine')->nullable();
            $table->string('Adresse');
            $table->date('dateNaissance');
            $table->string('cni')->unique()->nullable();
            $table->string('imageCni')->nullable();
            $table->timestamps();

            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idtontine')->references('id')->on('tontines');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
