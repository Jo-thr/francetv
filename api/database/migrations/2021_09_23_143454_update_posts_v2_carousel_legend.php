<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsV2CarouselLegend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('carousel_1_legend')->nullable();
            $table->string('carousel_2_legend')->nullable();
            $table->string('carousel_3_legend')->nullable();
            $table->string('carousel_4_legend')->nullable();
            $table->string('carousel_5_legend')->nullable();
            $table->string('carousel_6_legend')->nullable();
            $table->string('carousel_7_legend')->nullable();
            $table->string('carousel_8_legend')->nullable();
            $table->string('carousel_9_legend')->nullable();
            $table->string('carousel_10_legend')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'carousel_1_legend',
                'carousel_2_legend',
                'carousel_3_legend',
                'carousel_4_legend',
                'carousel_5_legend',
                'carousel_6_legend',
                'carousel_7_legend',
                'carousel_8_legend',
                'carousel_9_legend',
                'carousel_10_legend',
            ]);
        });
    }
}
