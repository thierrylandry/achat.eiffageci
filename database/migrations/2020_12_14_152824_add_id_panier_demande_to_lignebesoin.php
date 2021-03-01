<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdPanierDemandeToLignebesoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lignebesoin', function (Blueprint $table) {
            //
            $table->integer('id_panier_demande')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lignebesoin', function (Blueprint $table) {
            //
            $table->removeColumn('id_panier_demande');
        });
    }
}
