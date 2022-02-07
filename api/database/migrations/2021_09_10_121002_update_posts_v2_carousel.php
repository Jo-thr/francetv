<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsV2Carousel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('carousel_1')->nullable();
            $table->string('carousel_2')->nullable();
            $table->string('carousel_3')->nullable();
            $table->string('carousel_4')->nullable();
            $table->string('carousel_5')->nullable();
            $table->string('carousel_6')->nullable();
            $table->string('carousel_7')->nullable();
            $table->string('carousel_8')->nullable();
            $table->string('carousel_9')->nullable();
            $table->string('carousel_10')->nullable();
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
                'carousel_1',
                'carousel_2',
                'carousel_3',
                'carousel_4',
                'carousel_5',
                'carousel_6',
                'carousel_7',
                'carousel_8',
                'carousel_9',
                'carousel_10',
            ]);
        });
    }
}
