<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdteLivraisonEffToDa extends Migration
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
            $table->date("date_livraison_eff")->nullable();
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
            $table->removeColumn("date_livraison_eff");
        });
    }
}
