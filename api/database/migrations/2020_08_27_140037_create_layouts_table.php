<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('label');
            $table->string('name')->unique();

            $table->jsonb('title')->nullable();
            $table->jsonb('description')->nullable();

            $table->string('type');

            $table->jsonb('block1title')->nullable();
            $table->string('block1img')->nullable();
            $table->jsonb('block1imgalt')->nullable();

            $table->jsonb('block2title')->nullable();

            $table->string('background');
            $table->string('underline');
            $table->boolean('font_black');

            $table->nullableUuidMorphs('block1');
            $table->nullableUuidMorphs('block2');
            $table->nullableUuidMorphs('block3');

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
        Schema::dropIfExists('layouts');
    }
}
