<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_tags', function (Blueprint $table) {
            $table->id();

            $table->uuid('tag_id');
            $table->uuid('post_id');

            $table
                ->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE');

            $table
                ->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_tags');
    }
}
