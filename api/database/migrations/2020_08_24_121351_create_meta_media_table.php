<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_media', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('externalId')->unique();
            $table->string('title');
            $table->string('url');
            $table->string('image');
            $table->longText('description');
            $table->dateTime('published_at');
            $table->integer('sort_order');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE meta_media ADD searchable tsvector NULL');
        DB::statement('CREATE INDEX meta_media_searchable_index ON meta_media USING GIN (searchable)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_media');
    }
}
