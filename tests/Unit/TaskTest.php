<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use App\Models\Community;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $community;

    protected function setUp(): void
    {
        parent::setUp();
        // Créer une communauté pour les tests
        $this->community = Community::factory()->create();
    }

    public function test_task_creation()
    {
        $task = Task::create([
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
    }

    public function test_task_requires_title()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Task::create([
            'community_id' => $this->community->id,
            'description' => 'This task has no title.',
            'due_date' => now()->addDays(5),
            'status' => 'pending',
        ]);
    }

    public function test_task_belongs_to_community()
    {
        $task = Task::create([
            'community_id' => $this->community->id,
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'due_date' => now()->addDays(5),
            'status' => 'pending',
        ]);

        $this->assertInstanceOf(Community::class, $task->community);
        $this->assertEquals($this->community->id, $task->community->id);
    }

    public function test_due_date_casting()
    {
        $task = Task::create([
            'community_id' => $this->community->id,
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'due_date' => '2024-12-31',
            'status' => 'pending',
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $task->due_date);
        $this->assertEquals('2024-12-31', $task->due_date->toDateString());
    }
}
