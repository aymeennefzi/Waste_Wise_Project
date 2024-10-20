<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\event;
use Illuminate\Http\Request;

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
        $events = event::all();
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
        // $request->validate([
        //     'event_id' => 'required|exists:events,id',
        //     'task_type' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'start_time' => 'required|date',
        //     'end_time' => 'required|date|after:start_time',
        //     'estimated_duration' => 'required|integer',
        //     'cost_estimate' => 'required|numeric'
        // ]);


        print($request);
        $task = new Task();
         $task->event_id = $request->input('event_id');
        $task->task_type = $request->input('task_type');
        $task->description = $request->input('description');
        $task->start_time = $request->input('start_time');
        $task->end_time = $request->input('end_time');
        $task->estimated_duration = $request->input('estimated_duration');
        $task->cost_estimate = $request->input('cost_estimate');
        $task->save();

        return redirect()->route('taskse.index')->with('success', 'task created successfully');
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
        // return view('tasks.updateTasks', ['task' => $task]);


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
        // $request->validate([
        //     'event_id' => 'required|exists:events,id',
        //     'task_type' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'start_time' => 'required|date',
        //     'end_time' => 'required|date|after:start_time',
        //     'estimated_duration' => 'required|integer',
        //     'cost_estimate' => 'required|numeric'
        // ]);

        $task = Task::findOrFail($id);
        $task->event_id = $request->input('event_id');
        $task->task_type = $request->input('task_type');
        $task->description = $request->input('description');
        $task->start_time = $request->input('start_time');
        $task->end_time = $request->input('end_time');
        $task->estimated_duration = $request->input('estimated_duration');
        $task->cost_estimate = $request->input('cost_estimate');
        $task->save();

        $events = Event::all();

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
        $task->delete();

        return redirect()->route('taskse.index')->with('success', 'Task deleted successfully');
    }
}
