<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->jsonb('slug')->nullable()->unique();
            $table->string('url')->nullable()->unique();
            $table->jsonb('title');

            $table->jsonb('content_fr')->nullable();
            $table->jsonb('content_en')->nullable();

            $table->string('type')->nullable();
            $table->string('featured')->nullable();

            $table->string('heading')->nullable();

            $table->enum('category', ['external', 'default', 'contribution']);

            $table->jsonb('excerpt')->nullable();

            $table->time('time')->nullable();

            $table->text('author')->nullable();
            $table->text('speakers')->nullable();

            $table->datetime('published_at');

            $table->unsignedBigInteger('claps')->default(0);

            $table->unique('id');

            $table->string('preview_token')->nullable();

            $table->boolean('published')->default(true);

            $table->uuid('pictogram_id')->nullable();
            $table
                ->foreign('pictogram_id')
                ->references('id')
                ->on('pictograms');

            $table->uuid('user_id')->nullable();
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->integer('sort_order');

            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE posts ADD searchable tsvector NULL");
        DB::statement("CREATE INDEX posts_searchable_index ON posts USING GIN (searchable)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
