<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumeroBlToLigneBonLivraison extends Migration
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
            $table->string('numero_bl')->nullable();
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
            $table->removeColumn('numero_bl');
        });
    }
}
