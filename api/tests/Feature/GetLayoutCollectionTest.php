<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use SeedDataForTests;
use SeedPermissions;

class GetLayoutCollectionTest extends TestCase
{
    use RefreshDatabase;

    public function testGetLayoutCollection()
    {
        $this->seed(SeedPermissions::class);
        $this->seed(SeedDataForTests::class);

        $response = $this->get('/api/layouts');

        $response->assertStatus(200)
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
                    'data' =>
                    [
                        'name',
                        'primary' => [ 'block1', 'img', 'imgalt' ],
                        'secondary' => [ 'block2', 'block3' ],
                    ],
                ]
            ]
        ];
    }
}
