<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLigneBonlivraison extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_bonlivraison', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_devis')->nullable();
            $table->string('reference')->nullable();
            $table->integer('quantite')->nullable();
            $table->double('prix_unitaire')->nullable();
            $table->integer('id_fournisseur')->nullable();
            $table->date('date_reception')->nullable();
            $table->integer('etat')->nullable();
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
        Schema::dropIfExists('ligne_bonlivraison');
    }
}
