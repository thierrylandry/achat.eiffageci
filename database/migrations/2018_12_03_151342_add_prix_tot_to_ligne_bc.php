<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrixTotToLigneBc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligne_bc', function (Blueprint $table) {
            //
            $table->string('prix_tot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligne_bc', function (Blueprint $table) {
            //
            $table->removeColumn('prix_tot');
        });
    }
}
