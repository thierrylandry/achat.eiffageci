<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributToProjet extends Migration
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
            $table->string('denomination_courte')->nullable();
            $table->string('denomination_longue')->nullable();
            $table->string('n_rccm')->nullable();
            $table->string('n_cc')->nullable();
            $table->string('adresseGeographique')->nullable();
            $table->string('adressePostale')->nullable();
            $table->string('adresseReceptionFacture')->nullable();
            $table->string('adressePostaleReceptionFacture')->nullable();
            $table->string('portEPIObligatoire')->nullable();
            $table->string('use_tva')->nullable();
            $table->string('siege_social')->nullable();
            $table->string('conditionGeneralAchat')->nullable();
            $table->boolean('type_validation_bc')->nullable();
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
            $table->removeColumn('denomination_courte');
            $table->removeColumn('denomination_longue');
            $table->removeColumn('n_rccm');
            $table->removeColumn('n_cc');
            $table->removeColumn('adresseGeographique');
            $table->removeColumn('adressePostale');
            $table->removeColumn('adresseReceptionFacture');
            $table->removeColumn('adressePostaleReceptionFacture');
            $table->removeColumn('portEPIObligatoire');
            $table->removeColumn('use_tva');
            $table->removeColumn('siege_social');
            $table->removeColumn('conditionGeneralAchat');
            $table->removeColumn('type_validation_bc');
        });
    }
}
