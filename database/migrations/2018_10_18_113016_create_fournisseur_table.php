<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournisseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle');
            $table->string('domaine');
            $table->text('conditionPaiement')->nullable();
            $table->text('commentaire')->nullable();
            $table->string('adresseGeographique')->nullable();
            $table->string('responsable')->nullable();
            $table->string('interlocuteur')->nullable();
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournisseur');
    }
}
