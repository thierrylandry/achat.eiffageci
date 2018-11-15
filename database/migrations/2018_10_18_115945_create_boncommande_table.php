<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoncommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boncommande', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prixUnitaire');
            $table->string('remise');
            $table->integer('numBonCommande');
            $table->integer('id_user');
            $table->integer('id_analytique');
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
        Schema::dropIfExists('boncommande');
    }
}
