<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeAnalytiqueToMateriel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materiel', function (Blueprint $table) {
            //
            $table->string('code_analytique')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materiel', function (Blueprint $table) {
            //
            $table->removeColumn('code_analytique');
        });
    }
}
