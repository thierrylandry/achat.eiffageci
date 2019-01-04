<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemiseCodRubriqueIdDaToDevis extends Migration
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
            $table->integer('remise')->nullable();
            $table->integer('codeRubrique')->nullable();
            $table->string('id_da')->nullable();

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
            $table->integer('remise');
            $table->integer('codeRubrique');
            $table->string('id_da');
        });
    }
}
