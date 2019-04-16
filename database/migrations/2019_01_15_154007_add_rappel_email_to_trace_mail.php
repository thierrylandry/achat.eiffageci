<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRappelEmailToTraceMail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trace_mail', function (Blueprint $table) {
            //
            $table->integer('rappel')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trace_mail', function (Blueprint $table) {
            //
            $table->removeColumn('rappel');
            $table->removeColumn('email');
        });
    }
}
