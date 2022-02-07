<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class CreatePosts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 200; $i++) {
            Post::create([
            'title' => ['fr'=> 'test'.$i.'fr','en' => 'test'.$i.'en'],
            'slug' => ['fr'=> 'test'.$i.'fr','en' => 'test'.$i.'en'],
            'content' => 'test',
            'external' => false,
            'published_at' => now(),
            'heading' => 'infos',
          ]);
        }
    }
}
