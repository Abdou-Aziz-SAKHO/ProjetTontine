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
        Schema::table('tontines', function (Blueprint $table) {
            $table->unsignedBigInteger('gerant_id')->nullable()->after('id');
            $table->foreign('gerant_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tontines', function (Blueprint $table) {
            $table->dropForeign(['gerant_id']);
            $table->dropColumn('gerant_id');
        });
    }


    /**
     * Reverse the migrations.
     */

};
