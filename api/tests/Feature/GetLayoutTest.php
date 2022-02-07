<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Layout;

use SeedDataForTests;
use SeedPermissions;

class GetLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function testGetLayout()
    {
        $this->seed(SeedPermissions::class);
        $this->seed(SeedDataForTests::class);

        $layout = Layout::first();

        $response = $this->getJson('/api/layouts/'.$layout->slug);

        $response
        ->assertStatus(200)
        ->assertJsonStructure(
            $this->jsonStructure()
        );
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
