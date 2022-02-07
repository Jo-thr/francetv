<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLayoutsV2ParticipateInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->nullableUuidMorphs('participate_insert1');
            $table->jsonb('participate_insert1_Description')->nullable();
            $table->jsonb('participate_insert1_Button')->nullable();

            $table->nullableUuidMorphs('participate_insert2');
            $table->jsonb('participate_insert2_Description')->nullable();
            $table->jsonb('participate_insert2_Button')->nullable();

            $table->nullableUuidMorphs('participate_insert3');
            $table->jsonb('participate_insert3_Description')->nullable();
            $table->jsonb('participate_insert3_Button')->nullable();
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
                'participate_insert1',
                'participate_insert1_Description',
                'participate_insert1_Button',
                'participate_insert2',
                'participate_insert2_Description',
                'participate_insert2_Button',
                'participate_insert3',
                'participate_insert3_Description',
                'participate_insert3_Button',
            ]);
        });
    }
}
