<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdateLayoutsTable extends Migration
{
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->boolean('event_mode')->default(false);
            $table->text('iframe')->nullable();
            $table->jsonb('event_title')->nullable();
        });
    }
}
