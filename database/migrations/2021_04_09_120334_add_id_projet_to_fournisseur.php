<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdProjetToFournisseur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fournisseur', function (Blueprint $table) {
            //
            $table->integer('id_projet')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fournisseur', function (Blueprint $table) {
            //
            $table->removeColumn('id_projet');
        });
    }
}
