<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\TaskC; 
use App\Models\User; 

class TaskCController extends Controller
{
    public function index(Request $request)
    {
        $query = TaskC::with('community'); // Start the query
    
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
        return view('TasksCommunity.create', compact('communities'));
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

        taskC::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    public function edit(taskC $task)
    {
        $communities = Community::all();
        return view('TasksCommunity.edit', compact('task', 'communities'));
    }

    public function update(Request $request, taskC $task)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index', $task->id)->with('success', 'Tâche mise à jour avec succès.');
    }

    public function show(taskC $task)
    {
        return view('TasksCommunity.show', compact('task'));
    }

    public function destroy(taskC $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
    }


    
}
