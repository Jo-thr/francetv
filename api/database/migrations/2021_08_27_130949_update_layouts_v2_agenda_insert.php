<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLayoutsV2AgendaInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->nullableUuidMorphs('agenda_insert1');
            $table->date('agenda_insert1_startDate')->nullable();
            $table->date('agenda_insert1_endDate')->nullable();
            $table->jsonb('agenda_insert1_Description')->nullable();

            $table->nullableUuidMorphs('agenda_insert2');
            $table->date('agenda_insert2_startDate')->nullable();
            $table->date('agenda_insert2_endDate')->nullable();
            $table->jsonb('agenda_insert2_Description')->nullable();

            $table->nullableUuidMorphs('agenda_insert3');
            $table->date('agenda_insert3_startDate')->nullable();
            $table->date('agenda_insert3_endDate')->nullable();
            $table->jsonb('agenda_insert3_Description')->nullable();

            $table->nullableUuidMorphs('agenda_insert4');
            $table->date('agenda_insert4_startDate')->nullable();
            $table->date('agenda_insert4_endDate')->nullable();
            $table->jsonb('agenda_insert4_Description')->nullable();

            $table->nullableUuidMorphs('agenda_insert5');
            $table->date('agenda_insert5_startDate')->nullable();
            $table->date('agenda_insert5_endDate')->nullable();
            $table->jsonb('agenda_insert5_Description')->nullable();

            $table->nullableUuidMorphs('agenda_insert6');
            $table->date('agenda_insert6_startDate')->nullable();
            $table->date('agenda_insert6_endDate')->nullable();
            $table->jsonb('agenda_insert6_Description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->dropColumn([
                'agenda_insert1_id',
                'agenda_insert1_type',
                'agenda_insert1_startDate',
                'agenda_insert1_endDate',
                'agenda_insert1_Description'
            ]);
        });
    }
}
