@extends('layouts.adminLayout')
@section('content')

<div class="col-xl-9" style="padding: 20px;">
    <!-- Add a Create New Task Button -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Left: All Tasks Text -->
        <h2 style="margin: 0;">All Tasks by Event</h2>

        <!-- Right: Create New Task Button -->
        <a href="{{ route('tasks.create') }}" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 1rem; margin-right: 0px">
            <i class="fas fa-plus"></i> Create New Task
        </a>
    </div>

    @php
        $tasksByEvent = $tasks->groupBy(function($task) {
            return $task->event->eventName   ?? 'No Event';
        });
    @endphp

    @foreach ($tasksByEvent as $eventName => $eventTasks)
        <h3>{{ $eventName }}</h3>
        <!-- Compact Tasks Table -->
        <table class="table table-sm table-striped table-bordered" style="width: 100%; background-color: #fff; margin-bottom: 30px;">
            <thead style="background-color: #121111;">
                <tr>
                    <th>Task Type</th>
                    <th>Description</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Duration</th>
                    <th>Cost Estimate</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody style="color: #121111">
                @foreach ($eventTasks as $task)
                <tr>
                    <td>{{ $task->task_type }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->start_time }}</td>
                    <td>{{ $task->end_time }}</td>
                    <td>{{ $task->estimated_duration }} minutes</td>
                    <td>${{ number_format($task->cost_estimate, 2) }}</td>
                    <td style="text-align: center;">
                        <form action="{{ route('tasks.edit', $task->id) }}" method="GET" style="display: inline;">
                            <button type="submit" style="background-color: #28a745; color: white; padding: 5px; border-radius: 5px; border: none; font-size: 0.8rem; cursor: pointer;">
                                Edit
                            </button>
                        </form>

                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #dc3545; color: white; padding: 5px; border-radius: 5px; border: none; font-size: 0.8rem; cursor: pointer;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
