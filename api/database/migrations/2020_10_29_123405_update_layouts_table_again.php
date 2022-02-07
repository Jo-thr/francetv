<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdateLayoutsTableAgain extends Migration
{
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->string('block3img')->nullable();
            $table->jsonb('block3imgalt')->nullable();
        });
    }
}
