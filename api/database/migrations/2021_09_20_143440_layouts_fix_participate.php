<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LayoutsFixParticipate extends Migration
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
                'participate_insert1_type',
                'participate_insert2_type',
                'participate_insert3_type',
            ]);
        });
        Schema::table('layouts', function (Blueprint $table) {
            $table->string("participate_insert1_type")->nullable()->default(Post::class);
            $table->string("participate_insert2_type")->nullable()->default(Post::class);
            $table->string("participate_insert3_type")->nullable()->default(Post::class);
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
