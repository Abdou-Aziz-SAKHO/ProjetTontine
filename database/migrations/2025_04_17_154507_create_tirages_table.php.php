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
        Schema::create('tirages', function (Blueprint $table) {
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idtontine');
            $table->primary('iduser','idtontine');
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
        Schema::dropIfExists('tirages');
    }
};

