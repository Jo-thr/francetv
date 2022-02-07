<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsV2Content extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('v2')->nullable();
            $table->string('content_fr_v2_top')->nullable();
            $table->string('content_fr_v2_bottom')->nullable();
            $table->string('content_en_v2_top')->nullable();
            $table->string('content_en_v2_bottom')->nullable();
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
                'content_fr_v2_top',
                'content_fr_v2_bottom',
                'content_en_v2_top',
                'content_en_v2_bottom',
                'v2',
            ]);
        });
    }
}
