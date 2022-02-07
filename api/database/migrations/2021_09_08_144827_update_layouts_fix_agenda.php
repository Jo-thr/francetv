<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLayoutsFixAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
    $table->dropColumn([
        'agenda_insert1_type',
        'agenda_insert2_type',
        'agenda_insert3_type',
        'agenda_insert4_type',
        'agenda_insert5_type',
        'agenda_insert6_type',
    ]);
});
        Schema::table('layouts', function (Blueprint $table) {
            $table->string("agenda_insert1_type")->nullable()->default(Post::class);
            $table->string("agenda_insert2_type")->nullable()->default(Post::class);
            $table->string("agenda_insert3_type")->nullable()->default(Post::class);
            $table->string("agenda_insert4_type")->nullable()->default(Post::class);
            $table->string("agenda_insert5_type")->nullable()->default(Post::class);
            $table->string("agenda_insert6_type")->nullable()->default(Post::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
