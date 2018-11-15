<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLignebesoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignebesoin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unite');
            $table->float('quantite');

            $table->date('DateBesoin');
            $table->integer('id_user');
            $table->integer('id_fournisseur_select')->nullable(true);
            $table->integer('id_nature')->nullable(true);
            $table->integer('id_materiel')->nullable(true);
            $table->integer('id_boncommande')->nullable(true);
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
        Schema::dropIfExists('lignebesoin');
    }
}
