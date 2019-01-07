<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceDemandeurToBoncommende extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boncommande', function (Blueprint $table) {
            //
            $table->string('service_demandeur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boncommande', function (Blueprint $table) {
            //
            $table->removeColumn('service_demandeur');
        });
    }
}
