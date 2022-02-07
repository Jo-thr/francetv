<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;

use SeedPermissions;
use SeedDataForTests;

class GetPostsByTagTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPostsByTag()
    {
        $this->seed(SeedPermissions::class);
        $this->seed(SeedDataForTests::class);

        $randomTag = Tag::first();

        $response = $this->get('/api/tags/'.$randomTag->id.'/posts');

        $response
        ->assertStatus(200)
        ->assertJsonStructure($this->jsonStructure());
    }

    private function jsonStructure()
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'type',
                    'lang',
                    'category',
                    'data' =>
                    [
                        'title',
                        'content',
                        'featured',
                        'url',
                        'published_at',
                        'created_at',
                        'updated_at',

                    ],
                    'author' =>
                    [
                      'name',
                      'departement'
                    ],
                    'meta' =>
                    [
                      'slug' => ['en', 'fr']
                    ],
                ]
            ],
            'links' => ['first','last', 'prev','next']
        ];
    }
}
