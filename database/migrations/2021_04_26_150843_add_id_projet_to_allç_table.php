<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdProjetToAllçTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('lignebesoin', function (Blueprint $table) {
            //
            $table->integer('id_projet')->nullable(true)->default(1);
        });

        Schema::table('trace_mail', function (Blueprint $table) {
            //
            $table->integer('id_projet')->nullable(true)->default(1);
        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('id_projet')->nullable(true)->default(1);
        });
        Schema::table('ligne_bonlivraison', function (Blueprint $table) {
            //
            $table->integer('id_projet')->nullable(true)->default(1);
        });
        Schema::table('mouvement', function (Blueprint $table) {
            //
            $table->integer('id_projet')->nullable(true)->default(1);
        });
        Schema::table('designation_stockmin', function (Blueprint $table) {
            //
            $table->integer('id_projet')->nullable(true)->default(1);
        });

        Schema::table('devis', function (Blueprint $table) {
            //
            $table->integer('id_projet')->nullable(true)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('ecole', function (Blueprint $table) {
            Schema::table('lignebesoin', function (Blueprint $table) {
                //
                $table->removeColumn('id_projet');
            });

            Schema::table('trace_mail', function (Blueprint $table) {
                //
                $table->removeColumn('id_projet');
            });
            Schema::table('users', function (Blueprint $table) {
                //
                $table->removeColumn('id_projet');
            });
            Schema::table('ligne_bonlivraison', function (Blueprint $table) {
                //
                $table->removeColumn('id_projet');
            });
            Schema::table('mouvement', function (Blueprint $table) {
                //
                $table->removeColumn('id_projet');
            });
            Schema::table('designation_stockmin', function (Blueprint $table) {
                //
                $table->removeColumn('id_projet');
            });

            Schema::table('devis', function (Blueprint $table) {
                //
                $table->removeColumn('id_projet');
            });
        });
    }
}
