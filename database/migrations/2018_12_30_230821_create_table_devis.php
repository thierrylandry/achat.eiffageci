<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_materiel')->nullable();
            $table->integer('id_fournisseur')->nullable();
            $table->integer('quantite')->nullable();
            $table->bigInteger('prix_unitaire')->nullable();
            $table->string('titre_ext')->nullable();
            $table->string('devise')->nullable();
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
        Schema::dropIfExists('devis');
    }
}
