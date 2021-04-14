<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultLanguageTypeValidationDefaultDeviseToProjet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projets', function (Blueprint $table) {
            //
            $table->string('defaultLanguage')->default('fr');
            $table->boolean('typeValidation')->default(1);
            $table->string('defaultDevise')->default('XOF');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projets', function (Blueprint $table) {
            //
        });
    }
}
