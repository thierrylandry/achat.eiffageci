<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrixTouteDeviseDansDevise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devis', function (Blueprint $table) {
            //
            $table->string('prix_tot_usd')->nullable();
            $table->string('prix_tot_euro')->nullable();
            $table->string('prix_unitaire_usd')->nullable();
            $table->string('prix_unitaire_euro')->nullable();
            $table->string('valeur_tva_usd')->nullable();
            $table->string('valeur_tva_euro')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devis', function (Blueprint $table) {
            //
            $table->removeColumn('prix_tot_usd');
            $table->removeColumn('prix_tot_euro');
            $table->removeColumn('prix_unitaire_usd');
            $table->removeColumn('prix_unitaire_euro');
            $table->removeColumn('valeur_tva_usd');
            $table->removeColumn('valeur_tva_euro');
        });
    }
}
