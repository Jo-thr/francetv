<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostTableAgain extends Migration
{
    public function up()
    {
       Schema::table('posts', function (Blueprint $table) {
           $table->text('iframe')->nullable();
       });
    }
}
