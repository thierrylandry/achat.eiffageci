<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MiseAJourTableTraceMail extends Migration
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
            if (!Schema::hasColumn('trace_mail','objet')) {
                $table->string('objet')->nullable();
            }
            if (!Schema::hasColumn('lignebesoin','msg_contenu')) {
                $table->text('msg_contenu')->nullable();
            }
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
            $table->removeColumn('objet')->nullable();
            $table->removeColumn('msg_contenu')->nullable();
        });
    }
}
