<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugAndIdLignebesoinToReponseFournisseur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reponse_fournisseur', function (Blueprint $table) {
            //
            //
            $table->string('slug');
            $table->integer('id_lignebesoin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reponse_fournisseur', function (Blueprint $table) {
            //
            $table->removeColum('slug');
            $table->removeColum('id_lignebesoin');
        });
    }
}
