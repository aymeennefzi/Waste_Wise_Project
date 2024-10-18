<?php

namespace Tests\Feature;

use App\Models\User; // Import du modèle User
use App\Models\Community; // Import du modèle Community
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Créer un utilisateur avec un profil photo par défaut
        $this->user = User::factory()->create([
            'profile_photo_path' => '', // Assurez-vous que cela est renseigné
        ]);
        $this->actingAs($this->user); // Authentifier l'utilisateur
    }

    public function test_community_can_be_created()
    {
        $response = $this->post('/communities', [
            'name' => 'New Community',
            'description' => 'This is a new community.',
            'image_url' => null,
        ]);

        $response->assertRedirect(route('communities.index'));
        $this->assertDatabaseHas('communities', [
            'name' => 'New Community',
        ]);
    }

    public function test_community_creation_validation()
    {
        $response = $this->post('/communities', [
            'description' => 'No name provided',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_community_can_be_updated()
    {
        $community = Community::create([
            'name' => 'Old Community',
            'description' => 'This community will be updated.',
            'image_url' => null,
        ]);

        $response = $this->put("/communities/{$community->id}", [
            'name' => 'Updated Community',
            'description' => 'This community has been updated.',
            'image_url' => null,
        ]);

        $response->assertRedirect(route('communities.show', $community->id));
        $this->assertDatabaseHas('communities', [
            'name' => 'Updated Community',
        ]);
    }

    public function test_community_can_be_deleted()
    {
        $community = Community::create([
            'name' => 'Community to delete',
            'description' => 'This community will be deleted.',
            'image_url' => null,
        ]);

        $response = $this->delete("/communities/{$community->id}");

        $response->assertRedirect(route('communities.index'));
        $this->assertDatabaseMissing('communities', [
            'id' => $community->id,
        ]);
    }

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
