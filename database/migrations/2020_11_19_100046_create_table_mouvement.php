<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMouvement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouvement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_type_mouvement');
            $table->integer('quantite');
            $table->integer('id_demandeur')->nullable();
            $table->integer('id_imputation')->nullable();
            $table->integer('id_ligne_bonlivraison');
            $table->integer('id_materiel');
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
        Schema::dropIfExists('mouvement');
    }
}
