<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Heading;
use CreatePosts;

use SeedPermissions;
use SeedDataForTests;

class GetPostsByHeadingTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPostsByHeading()
    {
        $this->seed(SeedPermissions::class);
        $this->seed(SeedDataForTests::class);

        $heading = Heading::all()->first();

        $response = $this->get('/api/headings/'.$heading::$key.'/posts');

        $response->assertStatus(200);
    }
}
