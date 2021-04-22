<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdCodeComptableToDesignation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('designation', function (Blueprint $table) {
            //
            $table->integer('id_code_comptable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('designation', function (Blueprint $table) {
            //
            $table->removeColumn('id_code_comptable');
        });
    }
}
