<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\TaskC; 
use App\Models\Event; // Make sure to include Event model
use App\Events\NewNotification; // Include the notification event
use Illuminate\Support\Facades\Auth; // Include Auth for user information

class TaskCController extends Controller
{
    public function index(Request $request)
    {
        $query = TaskC::with('community', 'event'); // Include the Event model

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->has('community_id') && $request->community_id !== '') {
            $query->where('community_id', $request->community_id);
        }
    
        // Sorting
        if ($request->has('sort') && in_array($request->sort, ['due_date', 'status'])) {
            $query->orderBy($request->sort, 'asc'); // Change 'asc' to 'desc' for descending order
        }
    
        $tasks = $query->get(); // Execute the query
    
        $communities = Community::all(); // Get communities for the filter dropdown
    
        return view('TasksCommunity.index', compact('tasks', 'communities'));
    }
    
    public function create()
    {
        $communities = Community::all();
        $events = Event::all(); // Fetch all events
        return view('TasksCommunity.create', compact('communities', 'events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
            'event_id' => 'required|exists:events,id', // Validate event_id
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
            'start_time' => 'nullable|date', // Add validation for start time
            'end_time' => 'nullable|date',   // Add validation for end time
        ]);

        // Create a new TaskC
        $task = TaskC::create($validated);

        // Prepare data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'créé',
            'item' => 'tâche',
            'name' => $task->title,
        ];

        event(new NewNotification($data)); // Trigger notification event

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    public function edit(TaskC $task)
    {
        $communities = Community::all();
        $events = Event::all(); // Fetch all events for the edit view
        return view('TasksCommunity.edit', compact('task', 'communities', 'events'));
    }

    public function update(Request $request, TaskC $task)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
            'event_id' => 'required|exists:events,id', // Validate event_id
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
            'start_time' => 'nullable|date', // Add validation for start time
            'end_time' => 'nullable|date',   // Add validation for end time
        ]);

        $task->update($validated);

        // Prepare data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'tâche',
            'name' => $task->title,
        ];

        event(new NewNotification($data)); // Trigger notification event

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function show(TaskC $task)
    {
        return view('TasksCommunity.show', compact('task'));
    }

    public function destroy(TaskC $task)
    {
        // Prepare data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'tâche',
            'name' => $task->title,
        ];

        event(new NewNotification($data)); // Trigger notification event

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
    }
}
