<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneBcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_bc', function (Blueprint $table) {
            $table->increments('id');
            $table->string("codeRubrique")->nullable();
            $table->string('remise_ligne_bc')->nullable();
            $table->integer('quantite_ligne_bc')->nullable();
            $table->string('unite_ligne_bc')->nullable();
            $table->string('prix_unitaire_ligne_bc')->nullable();
            $table->integer('id_devis')->nullable();
            $table->integer('id_bonCommande')->nullable();
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
        Schema::dropIfExists('ligne_bc');
    }
}
