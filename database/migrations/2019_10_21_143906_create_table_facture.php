<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFacture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('factures')) {
            Schema::create('factures', function (Blueprint $table) {
                $table->increments('id');
                $table->date('dateRecepFact')->nullable();
                $table->date('dateFacturation')->nullable();
                $table->string('refFacture')->nullable();
                $table->integer('ctrlbcblFacture')->nullable();
                $table->float('montantFacture')->nullable();
                $table->text('commentaires')->nullable();
                $table->unsignedBigInteger('id_devis')->nullable();
                $table->foreign('id_devis')->references('id')->on('devis');
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
