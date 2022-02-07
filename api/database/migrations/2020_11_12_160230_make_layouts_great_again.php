<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeLayoutsGreatAgain extends Migration
{
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->jsonb('block3title')->nullable();
        });
    }
}
