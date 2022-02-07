<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->jsonb('title');
            $table->jsonb('slug')->unique();
            $table->string('paused')->default(false);
            $table->jsonb('content_fr')->nullable();

            $table->text('iframe_test')->nullable();

            $table->jsonb('content_en')->nullable();
            $table->string('externalId')->unique()->nullable();
            $table->datetime('start_at');
            $table->datetime('end_at');
            $table->unsignedBigInteger('share')->default(0);

            $table->jsonb('excerpt')->nullable();

            $table->boolean('published')->default(true);

            $table->uuid('sponsor_id')->nullable();
            $table
                ->foreign('sponsor_id')
                ->references('id')
                ->on('sponsors');

            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        DB::statement('ALTER TABLE tests ADD searchable tsvector NULL');
        DB::statement('CREATE INDEX tests_searchable_index ON tests USING GIN (searchable)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
