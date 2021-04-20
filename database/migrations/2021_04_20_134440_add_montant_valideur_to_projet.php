<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMontantValideurToProjet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projets', function (Blueprint $table) {
            //
            $table->integer('valideur1')->nullable();
            $table->integer('montant1')->nullable();
            $table->integer('valideur2')->nullable();
            $table->integer('montant2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projets', function (Blueprint $table) {
            //
            $table->removeColumn('valideur1');
            $table->removeColumn('montant1');
            $table->removeColumn('valideur2');
            $table->removeColumn('montant2');
        });
    }
}
