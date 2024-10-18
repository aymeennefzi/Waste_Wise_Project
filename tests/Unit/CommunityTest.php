<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Community;

class CommunityTest extends TestCase
{
    use RefreshDatabase; // Pour réinitialiser la base de données après chaque test

    public function test_community_creation()
    {
        $community = Community::create([
            'name' => 'Test Community',
            'description' => 'This is a test community.',
            'image_url' => null,
        ]);

        $this->assertDatabaseHas('communities', [
            'name' => 'Test Community',
            'description' => 'This is a test community.',
        ]);
    }

    public function test_community_requires_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Community::create([
            'description' => 'This community has no name.',
            'image_url' => null,
        ]);
    }

    public function test_example()
    {
        $this->assertTrue(true);
    }
}
