<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpgradeCreditsAndContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function ($table) {
            $table->string('content_fr_v2_top', 15000)->change();
            $table->string('content_fr_v2_bottom', 15000)->change();
            $table->string('content_en_v2_top', 15000)->change();
            $table->string('content_en_v2_bottom', 15000)->change();
            $table->string('credits_fr', 15000)->change();
            $table->string('credits_en', 15000)->change();
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
    }
}
