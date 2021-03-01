<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelgeValidationBc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regle_validation_bc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users');
            $table->integer('id_projet');
            $table->string('montant_minimum');
            $table->string('montant_maximum');
            $table->string('signature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regle_validation_bc');
    }
}
