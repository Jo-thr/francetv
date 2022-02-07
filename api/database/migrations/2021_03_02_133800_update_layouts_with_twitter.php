<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLayoutsWithTwitter extends Migration
{
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->text('iframe_twitter')->nullable();
        });
    }
}
