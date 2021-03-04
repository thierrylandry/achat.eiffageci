<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLibelleEnToTypeRapports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_rapport', function (Blueprint $table) {
            //
            $table->string('libelle_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_rapport', function (Blueprint $table) {
            //
            $table->removeColumn('libelle_en');
        });
    }
}
