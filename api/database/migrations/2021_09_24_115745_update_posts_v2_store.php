<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsV2Store extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('apple_url')->nullable();
            $table->integer('apple_rating')->nullable();
            $table->string('google_url')->nullable();
            $table->integer('google_rating')->nullable();
            $table->string('oculus_url')->nullable();
            $table->integer('oculus_rating')->nullable();

            $table->string('name_store_1')->nullable();
            $table->string('url_store_1')->nullable();
            $table->string('logo_store_1')->nullable();
            $table->integer('rating_store_1')->nullable();

            $table->string('name_store_2')->nullable();
            $table->string('url_store_2')->nullable();
            $table->string('logo_store_2')->nullable();
            $table->integer('rating_store_2')->nullable();
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
                'apple_url',
                'apple_rating',
                'google_url',
                'google_rating',
                'oculus_url',
                'oculus_rating',
                'name_store_1',
                'url_store_1',
                'logo_store_1',
                'rating_store_1',
                'name_store_2',
                'url_store_2',
                'logo_store_2',
                'rating_store_2',
            ]);
        });
    }
}
