<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReponseFournisseur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponse_fournisseur', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_fournisseur');
            $table->string('titre_ext')->nullable();
            $table->integer('quantite')->nullable();
            $table->string('unite')->nullable();
            $table->string('prix')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reponse_fournisseur');
    }
}
