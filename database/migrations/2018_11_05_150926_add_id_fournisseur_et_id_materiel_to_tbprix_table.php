<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdFournisseurEtIdMaterielToTbprixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbprix', function (Blueprint $table) {
            //
            $table->integer('id_fournisseur');
            $table->integer('id_materiel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbprix', function (Blueprint $table) {
            //
            $table->removeColumn('id_fournisseur');
            $table->removeColumn('id_materiel');
        });
    }
}
