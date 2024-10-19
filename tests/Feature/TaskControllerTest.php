<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Community;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $community;

    protected function setUp(): void
    {
        parent::setUp();

        // Créer un utilisateur et une communauté pour les tests
        $this->user = User::factory()->create();
        $this->community = Community::factory()->create();
    }

    public function test_index()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
        $response->assertViewHas('communities');
    }

    public function test_create()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
        $response->assertViewHas('communities');
    }

    public function test_store()
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), [
            'community_id' => $this->community->id,
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'due_date' => now()->addDays(5),
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
        ]);
        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('success', 'Tâche créée avec succès.');
    }

    public function test_edit()
    {
        $task = Task::factory()->create(['community_id' => $this->community->id]);

        $response = $this->actingAs($this->user)->get(route('tasks.edit', $task));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.edit');
        $response->assertViewHas('task', $task);
        $response->assertViewHas('communities');
    }

    public function test_update()
    {
        $task = Task::factory()->create(['community_id' => $this->community->id]);

        $response = $this->actingAs($this->user)->put(route('tasks.update', $task), [
            'community_id' => $this->community->id,
            'title' => 'Updated Task',
            'description' => 'Updated description.',
            'due_date' => now()->addDays(10),
            'status' => 'completed',
        ]);

        $task->refresh();

        $this->assertEquals('Updated Task', $task->title);
        $this->assertEquals('Updated description.', $task->description);
        $response->assertRedirect(route('tasks.show', $task->id));
        $response->assertSessionHas('success', 'Tâche mise à jour avec succès.');
    }

    public function test_show()
    {
        $task = Task::factory()->create(['community_id' => $this->community->id]);

        $response = $this->actingAs($this->user)->get(route('tasks.show', $task));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.show');
        $response->assertViewHas('task', $task);
    }

    public function test_destroy()
{
    // Créer une tâche à supprimer
    $task = Task::factory()->create(['community_id' => $this->community->id]);

    // Vérifier que la tâche existe dans la base de données avant de la supprimer
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
    ]);

    // Effectuer la requête de suppression
    $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $task));

    // Vérifier que la tâche a été supprimée
    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
    $response->assertRedirect(route('tasks.index'));
    $response->assertSessionHas('success', 'Tâche supprimée avec succès.');
}

    
}
