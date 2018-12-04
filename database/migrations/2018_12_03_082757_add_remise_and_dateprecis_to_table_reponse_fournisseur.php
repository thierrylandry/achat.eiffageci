<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemiseAndDateprecisToTableReponseFournisseur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('reponse_fournisseur', function (Blueprint $table) {
            //
            $table->integer('remise')->nullable();
            $table->integer('date_precise')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('reponse_fournisseur', function (Blueprint $table) {
            //
            $table->removeColumn('remise');
            $table->removeColumn('date_precise');
        });
    }
}
