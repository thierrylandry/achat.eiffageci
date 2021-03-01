<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdCodeTacheToLignesoin extends Migration
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
            $table->integer('id_codeTache')->nullable();
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
            $table->removeColumn('id_codeTache');
        });
    }
}
