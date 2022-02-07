<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsV2OtherProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('posts', 'other_project_1_type')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn([
                    'other_project_1_type',
                    'other_project_1_id',
                    'other_project_2_type',
                    'other_project_2_id',
                    'other_project_3_type',
                    'other_project_3_id',
                    'other_project_4_type',
                    'other_project_4_id',
                ]);
            });
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->string("other_project_1_type")->nullable()->default(Post::class);
            $table->uuid("other_project_1_id")->nullable();

            $table->string("other_project_2_type")->nullable()->default(Post::class);
            $table->uuid("other_project_2_id")->nullable();

            $table->string("other_project_3_type")->nullable()->default(Post::class);
            $table->uuid("other_project_3_id")->nullable();

            $table->string("other_project_4_type")->nullable()->default(Post::class);
            $table->uuid("other_project_4_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'other_project_1_type',
                'other_project_1_id',
                'other_project_2_type',
                'other_project_2_id',
                'other_project_3_type',
                'other_project_3_id',
                'other_project_4_type',
                'other_project_4_id',
            ]);
        });
    }
}
