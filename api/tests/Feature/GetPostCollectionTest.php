<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

use SeedDataForTests;
use SeedPermissions;

class GetPostCollectionTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPostCollection()
    {
        $this->seed(SeedPermissions::class);
        $this->seed(SeedDataForTests::class);

        $response = $this->get('/api/posts');

        Log::debug($response->getContent());
        $response
        ->assertStatus(200)
        ->assertJsonStructure($this->jsonStructure());
    }

    private function jsonStructure()
    {
        return [
            'data' => [
                '0' => [
                    'id',
                    'type',
                    'lang',
                    'category',
                    'position',
                    'slug',
                    'data' =>
                    [
                        'title',
                        'url',
                        'excerpt',
                        'featured',
                        'featuredalt',
                        'video',
                        'video_alt',
                        'video_square',
                        
                        'published_at',
                    ],
                    'meta' =>
                    [
                      'slug' => ['en', 'fr']
                    ],
                ]
            ]
        ];
    }
}
