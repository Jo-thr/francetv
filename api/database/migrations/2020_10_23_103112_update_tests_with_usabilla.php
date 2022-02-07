<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTestsWithUsabilla extends Migration
{
    public function up()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->string('desktop_trigger_fr')->nullable();
            $table->string('desktop_trigger_en')->nullable();
            $table->string('mobile_trigger_fr')->nullable();
            $table->string('mobile_trigger_en')->nullable();
            $table->unsignedInteger('trigger_time')->nullable();
        });
    }
}
