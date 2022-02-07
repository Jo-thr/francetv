<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use SeedDataForTests;
use SeedPermissions;

class GetMetaMediaCollectionTest extends TestCase
{
    use RefreshDatabase;

    public function testGetMetaMediaCollection()
    {
        $this->seed(SeedPermissions::class);
        $this->seed(SeedDataForTests::class);

        $response = $this->get('/api/meta-media');

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
                    'position',
                    'lang',
                    'data' =>
                    [
                        'title',
                        'url',
                        'description',
                        'published_at',
                        'created_at',
                        'updated_at',

                    ],
                ]
            ]
        ];
    }
}
