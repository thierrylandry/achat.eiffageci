<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdFournisseur extends Migration
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
            $table->integer('id_fournisseur');
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
            $table->removeColumn('id_fournisseur');
        });
    }
}
