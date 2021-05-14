<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrixUnitaireAllCurrencyToLigneBonlivraison extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligne_bonlivraison', function (Blueprint $table) {
            //
            $table->string('prix_unitaire_usd')->nullable();
            $table->string('prix_unitaire_euro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligne_bonlivraison', function (Blueprint $table) {
            //
            $table->removeColumn('prix_unitaire_usd');
            $table->removeColumn('prix_unitaire_euro');
        });
    }
}
