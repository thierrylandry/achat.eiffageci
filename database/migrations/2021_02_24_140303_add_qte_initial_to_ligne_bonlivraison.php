<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQteInitialToLigneBonlivraison extends Migration
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
            $table->float('qte_initial')->default(1);
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
            $table->removeColumn('qte_initial');
        });
    }
}
