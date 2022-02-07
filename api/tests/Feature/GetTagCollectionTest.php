<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use SeedPermissions;
use SeedDataForTests;

class GetTagCollectionTest extends TestCase
{
    use RefreshDatabase;

    public function testGetTagCollectionTest()
    {
        $this->seed(SeedPermissions::class);
        $this->seed(SeedDataForTests::class);

        $response = $this->get('/api/tags');

        $response->assertStatus(200);
    }
}
