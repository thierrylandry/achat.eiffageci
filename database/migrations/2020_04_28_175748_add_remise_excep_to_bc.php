<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemiseExcepToBc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boncommande', function (Blueprint $table) {
            //
            $table->integer('remise_excep')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boncommande', function (Blueprint $table) {
            //
            $table->dropColumn('remise_excep');
        });
    }
}
