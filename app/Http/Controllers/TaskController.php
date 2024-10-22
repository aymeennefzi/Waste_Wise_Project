<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use App\Events\NewNotification; // Ajoutez cette ligne
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Assurez-vous que cette ligne est présente

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.allTasks', ['tasks' => $tasks]);
    }

    public function index2()
    {
        $tasks = Task::all();
        return view('tasks.newTasks', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all();
        return view('tasks.addTasks', ['events' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'task_type' => 'required|string|max:255',
            'description' => 'required|string',
            'estimated_duration' => 'required|integer',
            'cost_estimate' => 'required|numeric'
        ]);

        // Create a new task
        $task = new Task();
        $task->event_id = $request->input('event_id');
        $task->task_type = $request->input('task_type');
        $task->description = $request->input('description');
        $task->start_time = $request->input('start_time');
        $task->end_time = $request->input('end_time');
        $task->estimated_duration = $request->input('estimated_duration');
        $task->cost_estimate = $request->input('cost_estimate');
        $task->save();

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'créé',
            'item' => 'tâche',
            'name' => $task->task_type,
        ];

        event(new NewNotification($data)); // Événement de notification

        return redirect()->route('taskse.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $events = Event::all();

        return view('tasks.updateTasks', compact('task', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'task_type' => 'required|string|max:255',
            'description' => 'required|string',
            'estimated_duration' => 'required|integer',
            'cost_estimate' => 'required|numeric'
        ]);

        // Find the task by ID
        $task = Task::findOrFail($id);

        // Update the task with the request data
        $task->event_id = $request->input('event_id');
        $task->task_type = $request->input('task_type');
        $task->description = $request->input('description');
        $task->start_time = $request->input('start_time');
        $task->end_time = $request->input('end_time');
        $task->estimated_duration = $request->input('estimated_duration');
        $task->cost_estimate = $request->input('cost_estimate');
        $task->save();

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'tâche',
            'name' => $task->task_type,
        ];

        event(new NewNotification($data)); // Événement de notification

        return redirect()->route('taskse.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'tâche',
            'name' => $task->task_type,
        ];

        event(new NewNotification($data)); // Événement de notification

        $task->delete();

        return redirect()->route('taskse.index')->with('success', 'Task deleted successfully');
    }
}
