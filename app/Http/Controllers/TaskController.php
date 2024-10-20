<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community; // Importer le modèle Community
use App\Models\Task; // Importer le modèle Task

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('community'); // Start the query
    
        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
    
        // Filtering by community
        if ($request->has('community_id') && $request->community_id !== '') {
            $query->where('community_id', $request->community_id);
        }
    
        // Sorting
        if ($request->has('sort') && in_array($request->sort, ['due_date', 'status'])) {
            $query->orderBy($request->sort, 'asc'); // Change 'asc' to 'desc' for descending order
        }
    
        $tasks = $query->get(); // Execute the query
    
        $communities = Community::all(); // Get communities for the filter dropdown
    
        return view('tasks.index', compact('tasks', 'communities'));
    }
    

    public function create()
    {
        $communities = Community::all();
        return view('tasks.create', compact('communities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    public function edit(Task $task)
    {
        $communities = Community::all();
        return view('tasks.edit', compact('task', 'communities'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.show', $task->id)->with('success', 'Tâche mise à jour avec succès.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
    }


    
}