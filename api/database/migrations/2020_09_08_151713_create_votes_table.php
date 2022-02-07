<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedInteger('note');

            $table->uuid('token_id');
            $table->uuid('test_id');

            $table
                ->foreign('token_id')
                ->references('id')
                ->on('tokens')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE');

            $table
                ->foreign('test_id')
                ->references('id')
                ->on('tests')
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
        Schema::dropIfExists('votes');
    }
}
