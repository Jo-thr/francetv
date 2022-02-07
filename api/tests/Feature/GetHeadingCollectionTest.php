<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetHeadingCollectionTest extends TestCase
{
    public function testGetHeadingCollection()
    {
        $response = $this->get('/api/headings');

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
                    'data' => [ 'label', 'slug' ],
                    'meta' => [
                        'slug' => ['fr', 'en']
                    ]
                ]
            ]
        ];
    }
}
