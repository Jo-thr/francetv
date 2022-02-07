<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTestEnIframe extends Migration
{
    public function up()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->text('iframe_en')->nullable();
        });
    }
}
